<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name'          => 'required',
            'description'   => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'nullable|date',
            'sponsor'       => 'required',
            'initiative'    => 'required',
            'amoa'          => 'required',
            'moe'           => 'nullable',
            'natures'       => 'required|array',
            'steps'         => 'nullable',
            'manager'       => 'required',
            'progress'      => 'required|integer|between:0,100',
            'cost'          => 'nullable|integer',
            'status'        => 'required',
            'benefits'      => 'required',
            'documentation' => 'nullable|string',
            'bills'         => 'nullable|string'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'          => 'Nom du projet',
            'description'   => 'Description',
            'start_date'    => 'Date de début',
            'end_date'      => 'Date de fin',
            'sponsor'       => 'Sponsor/MOA',
            'initiative'    => 'Initiative',
            'amoa'          => 'AMOA',
            'moe'           => 'MOE',
            'natures'       => 'Nature(s)',
            'steps'         => 'Etape(s)',
            'manager'       => 'Chef de projet',
            'progress'      => 'Progression',
            'cost'          => 'Coût',
            'status'        => 'Statut',
            'benefits'      => 'Gains/Impact',
            'documentation' => 'Documentation',
            'bills'         => 'Factures'
        ];
    }
}
