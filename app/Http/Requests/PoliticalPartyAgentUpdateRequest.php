<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoliticalPartyAgentUpdateRequest extends FormRequest
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
            'political_party'               => 'required|min:3',
            'name'                          => 'required|min:3',
            //'agent_picture'                 => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'lga_id'                        => 'required',
            'wards_id'                      => 'required',
            'polling_unit_id'               => 'required',
            'designation'                   => 'required',
            'home_address'                  => 'required',
            'mobile'                        => 'required',
            'extra_mobile'                  => 'nullable',
            'signature_agent'               => 'required',
            'signature_auth_party_officials' => 'required',
            'name_party_chairman'           => 'required',
            'signature_party_chairman'      => 'required',
            'name_electoral_officer'        => 'required',
            'signature_electoral_officer'   => 'required',
        ];
    }
}
