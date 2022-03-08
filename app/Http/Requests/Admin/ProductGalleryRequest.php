<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductGalleryRequest extends FormRequest
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
            'products_id' => 'required|exists:products,id',
            'photos' => 'required|image'

            // setiap request berhubungan dengan client side, jika request data maka tolong check
            // [LOOK AT HTML ATTRIBUTE NAME!] photos = attribute html jika ada baru masuk
            // products_id juga, jika attribute html ada, maka akan masuk ke server.
            // tujuan request ini untuk validasi data yang di request dari front end apakah ada atau tidak karena memakai
            // teknik required
        ];
    }
}
