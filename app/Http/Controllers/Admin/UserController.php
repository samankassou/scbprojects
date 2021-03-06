<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::with(['roles'])->get();
            return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('status', function($user){
                $checked =  ($user->status) ? "checked" : "";
                $title = ($user->status) ? "Désactiver" : "Activer";
                $btn = "<div class='form-check form-switch' title=$title onclick='toggleUserStatus($user->id)'>
                            <input class='form-check-input' style='cursor: pointer' type='checkbox' $checked>
                        </div>";
                return $btn;
            })
            ->addColumn('action', function($user){
                $actionBtns = "<button class='btn btn-sm btn-primary' title='Détails' onclick='showUserInfosModal($user->id)'><i class='bi bi-eye'></i></button> ";
                $actionBtns .= "<button class='btn btn-sm btn-warning' title='Modifier' onclick='showEditUserModal($user->id)'><i class='bi bi-pencil'></i></button> ";
                $actionBtns .= "<button class='btn btn-sm btn-danger' title='Supprimer' onclick='showDeleteUserModal($user->id)'><i class='bi bi-trash'></i></button>";
                return $actionBtns;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
        }
        $usersRoles = Role::all();
        return view('admin.users.index', compact('usersRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 1,
            'password' => bcrypt("scb123"),
            'remember_token' => Str::random(10),
        ]);
        $user->roles()->attach([$request->role]);
        return response()->json(['message' => 'User saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles');
        return response()->json(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load('roles');
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->roles()->sync([$request->role]);
        return response()->json(['message' => 'User updated successfully!']);
    }

    /**
     * Update the user's status.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus(User $user)
    {
        if(auth()->user()->id == $user->id){
            return response()->json(['message' => 'You cannot remove this user']);
        }
        $user->status = !$user->status;
        $user->save();
        return response()->json([
            'message' => 'User\'s status updated!',
            'user' => $user,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->id == $user->id){
            return response()->json(['message' => 'You cannot delete this user'], 403);
        }
        if(!empty($user->project_modifications)){
            foreach($user->project_modifications as $modification){
                $modification->delete();
            }
        }
        $user->delete();
        return response()->json(['message' => 'User deleted!']);
    }

    public function settings()
    {
        return view('admin.users.settings');
    }

    public function updateInfos(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id),
            ]
        ]);
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json(['message' => 'User updated!']);
    }
    
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $user = User::find(auth()->user()->id);
        if(!Hash::check($request->actual_password, $user->password)){
            throw ValidationException::withMessages([
                'actual_password' => ['Mot de passe incorrect']
            ]);
            return;
        }

        
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message' => 'Password updated']);
    }
}
