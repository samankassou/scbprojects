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

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'method'                   => 'Process',
            'name'                     => 'Intitulé',
            'type'                     => 'Type',
            'reference'                => 'Reférence',
            'version'                  => 'Version',
            'entities'                 => 'Entités',
            'creation_date'            => 'Date de création',
            'created_by'               => 'Créée le',
            'writing_date'             => 'Date de rédaction',
            'written_by'               => 'Rédigée par',
            'verification_date'        => 'Date de vérification',
            'verified_by'              => 'Vérifiée par',
            'date_of_approval'         => 'Date d\'approbation',
            'approved_by'              => 'Approuvée par',
            'state'                    => 'Etat',
            'status'                   => 'Statut',
            'broadcasting_date'        => 'Date de diffusion',
            'reasons_for_creation'     => 'Raison de la création',
            'reasons_for_modification' => 'Raison de la modification',
            'appendices'               => 'Annexes'
        ];
    }
}
