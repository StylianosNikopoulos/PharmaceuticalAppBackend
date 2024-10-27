<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'name'                => 'required|string|max:255|unique:products,name',
            'category'            => 'required|string|max:255',
            'active_ingredients'  => 'required|string',
            'batch_number'        => 'required|string|max:255|unique:products,batch_number',
            'status'              => ['required', 'string', Rule::in(['under development', 'in clinical trials', 'completed'])],
            'manufacturing_date'  => 'required|date|before_or_equal:today',
            'expiration_date'     => 'required|date|after:manufacturing_date',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name'                => strip_tags(trim($this->input('name'))),
            'category'            => strip_tags(trim($this->input('category'))),
            'active_ingredients'  => strip_tags(trim($this->input('active_ingredients'))),
            'batch_number'        => strip_tags(trim($this->input('batch_number'))),
            'status'              => strip_tags(trim($this->input('status'))),
            'manufacturing_date'  => trim($this->input('manufacturing_date')),
            'expiration_date'     => trim($this->input('expiration_date')),
        ]);
    }

    public function messages()
    {
        return [
            'name.required'                 => 'The product name is required.',
            'name.unique'                   => 'The product name has already been taken.',
            'category.required'             => 'The category is required.',
            'active_ingredients.required'   => 'Active ingredients are required.',
            'batch_number.required'         => 'The batch number is required.',
            'batch_number.unique'           => 'The batch number has already been taken.',
            'status.required'               => 'The research status is required.',
            'status.in'                     => 'The selected research status is invalid.',
            'manufacturing_date.required'   => 'The manufacturing date is required.',
            'manufacturing_date.before_or_equal' => 'The manufacturing date must be today or earlier.',
            'expiration_date.required'      => 'The expiration date is required.',
            'expiration_date.after'         => 'The expiration date must be after the manufacturing date.',
        ];
    }
}
