<?php

namespace App\Http\Requests\API;

use App\Models\admin_access;
use InfyOm\Generator\Request\APIRequest;

class Updateadmin_accessAPIRequest extends APIRequest
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
        $rules = admin_access::$rules;
        
        return $rules;
    }
}
