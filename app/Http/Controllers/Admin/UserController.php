<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

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
                $actionBtns = "<a href=".route('admin.users.show', $user->id)." title='Détail' data-id=".$user->id." class='btn btn-sm btn-primary'><i class='bi bi-eye'></i></a> ";
                $actionBtns .= "<button class='btn btn-sm btn-warning' title='Modifier' data-id=".$user->id."><i class='bi bi-pencil'></i></button> ";
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'password' => bcrypt($request->password),
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
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
            return response()->json(['message' => 'You cannot delete this user']);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted!']);
    }
}
