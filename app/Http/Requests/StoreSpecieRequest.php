<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSpecieRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:species|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da espécie é obrigatório',
            'name.unique' => 'Já existe uma espécie cadastrada com esse nome',
            'name.max' => 'O nome da espécie ultrapassa o limite de 50 caracteres',
            'name.string' => 'O nome deve ser uma string'
        ];
    }
}
