<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch($this->method())
        {
           // case 'GET':
             //   return [
             //       'id' => ['bail', 'required', 'exists:users'],
             //   ];
            //break;

            case 'POST':
                return [
                    'first_name' => ['bail', 'string'],
                    'last_name' => ['bail', 'string'],
                    'username' => ['bail', 'string', 'unique:users'],
                    'email' => ['bail', 'required', 'email', 'unique:users'],
                    'password' => ['bail', 'string', 'confirmed', 'min:8', 'max:25'],
                    'mobile' => ['bail', 'string', 'unique:users'],
                    'home_phone' => ['bail', 'string'],
                    'work_phone' => ['bail', 'string'],
                    'work_address' => ['bail', 'string'],
                    'image' => ['bail', 'string'],
                ];
            break;

            case 'PATCH':
                return [
                    'first_name' => ['bail', 'string'],
                    'last_name' => ['bail', 'string'],
                    'home_phone' => ['bail', 'string'],
                    'work_phone' => ['bail', 'string'],
                    'work_address' => ['bail', 'string'],
                    'image' => ['bail', 'string'],
                ];
            break;
        }
    }
}
