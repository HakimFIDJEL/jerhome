<?php

namespace App\Http\Requests\admin\members;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class PlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pricing_id' => ['required', 'exists:pricings,id'],
            'nutrition_option' => ['required', 'boolean'],
            'start_date' => ['sometimes', 'date'],
            'expiration_date' => ['sometimes', 'date'],
            'sessions_left' => ['sometimes', 'integer', 'min:0'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'pricing_id.required' => 'Le tarif est requis',
            'pricing_id.exists' => 'Le tarif est invalide',

            'nutrition_option.required' => 'L\'option nutrition est requise',
            'nutrition_option.boolean' => 'L\'option nutrition est invalide',

            'start_date.date' => 'La date de début est invalide',

            'expiration_date.date' => 'La date d\'expiration est invalide',

            'sessions_left.integer' => 'Le nombre de séances restantes est invalide',
            'sessions_left.min' => 'Le nombre de séances restantes doit être supérieur ou égal à 0',
        ];
    }
}
