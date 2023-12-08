<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

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
        $rules = [
            'name'=>'required|string|min:6|max:20',
            'email' => ['required|email'],
            'phone' => 'required|numeric',
            'position' => 'required|string',
            'department' => 'required|string',
            'salary' => 'required|numeric|between:0,9999999.99',
            'photo'=> [
                File::image()
                    ->types(['png', 'jpg', 'jpeg'])
                    ->min(500)
                    ->max(4096)
            ],
            // or // 'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        
        // Unique email validation for store operation
        if ($this->isMethod('post')) {
            $rules['email'] = 'required|email|unique:employees';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees')->ignore($this->route('employee')),
            ];
        }

        return $rules;

    }
}
