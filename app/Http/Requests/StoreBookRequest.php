<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:books,isbn',
            'description' => 'nullable|string',
            'published_year' => ['required|integer|min:1900|max:'.date('Y')],
            'total_copies' => 'required|integer|min:1000',
            'available_copies' => 'required|integer|min:500|lte:total_copies'
        ];
    }
}
