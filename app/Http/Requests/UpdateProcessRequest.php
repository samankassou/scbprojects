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
            'method'                   => 'required|exists:methods,id',
            'name'                     => 'required',
            'type'                     => 'required',
            'reference' => [
                'required',
                Rule::unique('processes')->ignore($this->process->id),
            ],
            'version'                  => 'required',
            'entities'                 => 'required|array',
            'creation_date'            => 'required|date',
            'created_by'               => 'required',
            'written_date'             => 'nullable|date',
            'written_by'               => 'nullable',
            'verification_date'        => 'nullable|date',
            'verified_by'              => 'nullable',
            'approved_date'            => 'nullable|date',
            'approved_by'              => 'nullable',
            'state'                    => 'required',
            'reasons_for_creation'     => 'nullable',
            'reasons_for_modification' => 'required',
            'appendices'               => 'nullable',

        ];
    }
}
