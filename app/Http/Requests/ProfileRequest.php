<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "user_id"       => "required|exists:users,id",
            "first_name"    => "required|min:3|max:100",
            "last_name"     => "required|min:3|max:100",
            "gender"        => "required",
            "address"       => "required|min:10|max:50",
            "phone_number"  => "required|min:12|max:20",
        ];
    }
}
