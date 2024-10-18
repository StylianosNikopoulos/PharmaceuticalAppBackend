<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'category' => 'required|nullable|string|max:255',
            'active_ingredients' => 'required|nullable|string|max:255', 
            'batch_number' => 'required|string|max:255|unique:products,batch_number',
            'status' => 'required|nullable|string',
            'manufacturing_date' => 'required|date|before_or_equal:today', 
            'expiration_date' => 'required|date|after:manufacturing_date', 
             
        ];
    }
}
