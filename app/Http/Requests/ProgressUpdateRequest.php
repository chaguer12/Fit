<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgressUpdateRequest extends FormRequest
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
            'poids' => 'sometimes|numeric',
            'taille' => 'sometimes|numeric',
            'age' => 'sometimes|numeric',
            'chest' => 'sometimes|numeric',
            'bicep' => 'sometimes|numeric',
            'leg' => 'sometimes|numeric',
        ];
    }
}