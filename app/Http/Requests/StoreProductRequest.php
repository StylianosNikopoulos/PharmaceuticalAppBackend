<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:255|unique:products,name',
            'category'           => 'required|string|max:255',
            'active_ingredients' => 'required|string|max:255',
            'batch_number'       => 'required|string|max:255|unique:products,batch_number',
            'status'             => 'required|string|in:under development,in clinical trials,completed',
            'manufacturing_date' => 'required|date|before_or_equal:today',
            'expiration_date'    => 'required|date|after:manufacturing_date',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name'               => strip_tags(trim($this->input('name'))),
            'category'           => strip_tags(trim($this->input('category'))),
            'active_ingredients' => strip_tags(trim($this->input('active_ingredients'))),
            'batch_number'       => strip_tags(trim($this->input('batch_number'))),
            'status'             => strip_tags(trim($this->input('status'))),
            'manufacturing_date' => trim($this->input('manufacturing_date')),
            'expiration_date'    => trim($this->input('expiration_date')),
        ]);
    }
}
