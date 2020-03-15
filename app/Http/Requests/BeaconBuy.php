<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BeaconBuy extends FormRequest
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
            'name' => 'required|max:255',
            'family' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'beacon_number' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام را وارد کنید',
            'family.required' => 'نام خانوادگی را وارد کنید',
            'phone.required' => 'شماره تماس را وارد کنید',
            'address.required' => 'آدرس را وارد کنید',
            'beacon_number.required' => 'تعداد بیکن را وارد کنید'
        ];
    }
}
