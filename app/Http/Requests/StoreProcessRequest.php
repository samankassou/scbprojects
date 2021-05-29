<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessRequest extends FormRequest
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
            'method' => 'required|exists:methods,id',
            'name' => 'required',
            'type' => 'required',
            'reference' => 'required',
            'version' => 'required',
            'entity' => 'required|exists:entities,id',
            'creation_date' => 'required|date',
            'written_date' => 'required|date',
            'validation_date' => 'required|date',
            'approved_date' => 'required|date',
            'created_by' => 'required',
            'written_by' => 'required',
            'validated_by' => 'required',
            'approved_by' => 'required',
        ];
    }
}
