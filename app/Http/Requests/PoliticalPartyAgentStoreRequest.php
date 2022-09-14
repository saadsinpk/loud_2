<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoliticalPartyAgentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'political_party'   => 'required|min:3',
            'name'              => 'required|min:3',
            'agent_picture'     => 'required',
            'lga_id'            => 'required',
            'wards_id'          => 'required',
            'polling_unit_id'   => 'required',
            'designation'       => 'required',
            'home_address'      => 'required',
            'mobile'            => 'required',
            'extra_mobile'      => 'nullable'
        ];
    }
}
