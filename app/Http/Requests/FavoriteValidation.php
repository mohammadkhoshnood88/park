<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteValidation extends FormRequest
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
            'favorite' => 'required|unique:favorites',
            'favoritefile' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'favorite.required' => 'نام را وارد کنید',
            'favorite.unique' => 'این دسته بندی استفاده شده است',
            'favoritefile.required' => 'تصویر را بارگزاری کنید',
//            'favoritefile.extension' => 'فرمت فایل صحیح نیست',
        ];
    }
}
