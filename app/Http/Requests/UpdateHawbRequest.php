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
            'mawb' => 'required',
            'dest' => 'required',
            'desti' => 'required',
            'fltno' => 'required',
            'fltdate' => 'required|date',
            'forward' => 'required',
            'seller' => 'required',
            'factory' => 'required',
            'carrier' => 'required|min:2|max:4',
            'carriername' => 'required',
            'num' => 'required|numeric',
            'gw' => 'required|numeric',
            'cw' => 'required|numeric',
            'cbm' => 'required|numeric',
            'paymt' => 'required|in:CC,CP,PP,PC',
            'arranged' => 'required'
        ];
    }
}
