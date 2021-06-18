<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProcessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'edit-type'                => 'required',
            'method'                   => 'required|exists:methods,id',
            'name'                     => 'required',
            'type'                     => 'required',
            'reference'                => 'required',
            'version'                  => 'required',
            'entities'                 => 'required|array',
            'entities.*'               => 'nullable|exists:entities,id',
            'creation_date'            => 'required|date',
            'created_by'               => 'required',
            'writing_date'             => 'nullable|date',
            'written_by'               => 'exclude_if:written_date,null|required',
            'verification_date'        => 'nullable|date',
            'verified_by'              => 'exclude_if:verification_date,null|required',
            'date_of_approval'         => 'nullable|date',
            'approved_by'              => 'exclude_if:date_of_approval,null|required',
            'state'                    => 'required',
            'status'                   => 'required',
            'broadcasting_date'        => 'nullable|date',
            'reasons_for_creation'     => 'required_if:state,Créé',
            'reasons_for_modification' => 'required_if:state,Revu',
            'appendices'               => 'nullable|string',
        ];
    }
}
