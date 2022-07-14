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
        $rules = ['password' => [
            'required',
            'min:8',
            'max:32',
        ],
            'password_confirmation' => 'required|same:password'];
        if ($this->getMethod() == 'POST') {
            $rules += [
                'email' => 'required|unique:users,email',
                'username'=> 'required|string|max:255|alpha_dash|unique:users,username',
                'name'=> 'required|string|max:255',
                'avatar'=> 'file',
            ];

        }
        if ($this->getMethod() == 'PUT') {
            if ($this->password == null) {
                unset($rules['password']);
                unset($rules['password_confirmation']);
            }
            $rules += [
                'email' => 'required|unique:users,email,' .$this->id. ',id',
                'username'=> 'required|string|max:255|alpha_dash|unique:users,username',
                'name'=> 'required|string|max:255',
                'avatar'=> 'file',
            ];
        }
        
        return $rules;
    }
}
