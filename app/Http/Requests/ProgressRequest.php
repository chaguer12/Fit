<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgressRequest extends FormRequest
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
            'poids' => 'required|numeric',
            'taille' => 'required|numeric',
            'age' => 'required|numeric',
            'chest' => 'required|numeric',
            'bicep' => 'required|numeric',
            'leg' => 'required|numeric',
        ];
    }
}