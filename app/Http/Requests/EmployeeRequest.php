<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            "name" => ["required", "string"],
            "email" => ["required", "string", "email", "lowercase", "unique:users,email"],
            "phone_number" => ["required", "string"],
            "address" => ["required", "string"],
            "birth_date" => ["required", "string"],
            "reg_number" => ["required", "string"],
            "job_title" => ["required", "string"],
            "department" => ["required", "string"],
            "base_location" => ["required", "string"],
            "contract_type" => ["required", "string"],
            "bank_name" => ["required", "string"],
            "bank_account_name" => ["required", "string"],
            "bank_account_number" => ["required", "string"],
        ];
    }
}
