<?php

namespace App\Infrastructure\Members;

use Illuminate\Foundation\Http\FormRequest;

class SignUpMemberFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email:dns,rfc', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];;
    }
}
