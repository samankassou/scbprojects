<?php

namespace App\Http\Requests;

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
            'method'                   => 'required|exists:methods,id',
            'name'                     => 'required',
            'type'                     => 'required',
            'reference'                => 'required',
            'version'                  => 'required',
            'pole'                     => 'required',
            'entity'                   => 'required',
            'creation_date'            => 'required|date',
            'created_by'               => 'required',
            'written_date'             => 'required|date',
            'written_by'               => 'required',
            'validation_date'          => 'required|date',
            'validated_by'             => 'required',
            'validation_date'          => 'required|date',
            'validated_by'             => 'required',
            'approved_date'            => 'required|date',
            'approved_by'              => 'required',
            'state'                    => 'required',
            'reasons_for_creation'     => 'nullable',
            'reasons_for_modification' => 'nullable',
            'appendices'               => 'nullable',

        ];
    }
}
