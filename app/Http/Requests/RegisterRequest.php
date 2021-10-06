<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

    /**
     * author: ahmad montazeri
     * 29 sep 2021 13:57
     */
class RegisterRequest extends FormRequest
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
        //dd("ok");
        return [
            'first_name' => ['bail', 'required', 'string', 'min:8', 'max:25'],
            'last_name' => ['bail', 'required', 'string', 'min:8', 'max:25'],
            'username' => ['bail', 'required', 'string', 'unique:users', 'min:8', 'max:25'],
            'email' => ['bail', 'required', 'email', 'unique:users'],
            'password' => ['bail', 'string', 'confirmed', 'min:8', 'max:25'],
            'mobile' => ['bail', 'string', 'required', 'unique:users', 'digits:11'],
            'home_phone' => ['bail', 'string', 'required', 'digits:15'],
            'work_phone' => ['bail', 'string', 'required', 'digits:15'],
            'work_address' => ['bail', 'string', 'required', 'min:5', 'max:300'],
            'home_address' => ['bail', 'string', 'required', 'min:5', 'max:300'],
            'image' => ['nullable','bail','image','mimes:jpeg,png','max:512']
        ];
    }

    //public function message()
    //{
    //    return [
    //        'first_name' => '',
    //        'last_name' => '',
     //       'username' => '',
     //       'email.required' => '',
     //       'password' => '',
     //       'mobile' => '',
     //       'home_phone' => '',
     //       'work_phone' => '',
     //       'work_address' => '',
      //      'image' => '',
     //   ];
   // }
}
