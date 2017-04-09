<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateHawbRequest extends Request
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
            'opdate' => 'required|date',
            'hawb' => 'required',
            'mawb' => 'regex:/^\d{3}-\d{8}$/|ismawb',
            'dest' => 'required',
            'desti' => 'required',
            'fltno' => 'regex:/^[A-Z0-9]{2}\d{2,4}$/',
            'fltdate' => 'required|date',
            'forward' => 'required',
            'seller' => 'required',
            'factory' => 'required',
            'carrier' => 'min:2|max:4',
            'num' => 'required|numeric|min:1',
            'gw' => 'required|numeric|min:1',
            'cw' => 'required|numeric|min:1',
            'cbm' => 'required|numeric|min:0.001',
            'paymt' => 'required|in:CC,CP,PP,PC',
            'arranged' => 'required'
        ];
    }
}
