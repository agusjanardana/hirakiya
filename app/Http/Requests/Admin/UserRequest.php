<?php

namespace App\Http\Requests\Admin;

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
        // laravel -> formrequest validation
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users', // data email uniq, tidak boleh sama makanaya unique:users ( table users )
            'roles' => 'nullable|string|in:ADMIN,USER' // in artinya, inputan hanya 2 admin dan user.
        ];
    }
}
