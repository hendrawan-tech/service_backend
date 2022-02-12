<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'code' => ['required', 'max:8', 'string'],
            'name' => ['required', 'max:100', 'string'],
            'brand' => ['required', 'max:30', 'string'],
            'condition' => ['required', 'max:255', 'string'],
            'attribute' => ['required', 'max:255', 'string'],
            'problem' => ['required', 'max:255', 'string'],
            'specification' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'status' => ['required', 'in:{IMPLODED_OPTIONS}'],
            'product_category_id' => [
                'required',
                'exists:product_categories,id',
            ],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
