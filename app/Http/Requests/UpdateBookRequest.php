<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
            'title' => 'sometimes|required|string|max:255',
            'author_name' => 'sometimes|required|string|max:255',
            'isbn' => ['sometimes', 'required', 'string', 'max:20', Rule::unique('books')->ignore($this->book)],
            'description' => 'nullable|string',
            'published_year' => 'sometimes|required|integer|min:1900|max:'.date('Y'),
            'total_copies' => 'sometimes|required|integer|min:1000',
            'available_copies' => 'sometimes|required|integer|min:500'
        ];
    }
}
