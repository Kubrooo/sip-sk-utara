<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreSkTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasAnyRole(['admin_kecamatan', 'bagian_hukum']) ?? false;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:50', 'regex:/^[A-Za-z0-9_-]+$/', 'unique:sk_templates,code'],
            'title' => ['required', 'string', 'max:255'],
            'html_template' => ['required', 'string'],
            'dynamic_fields' => ['required', 'array', 'min:1'],
            'dynamic_fields.*.name' => ['required', 'string', 'max:80', 'regex:/^[a-z][a-z0-9_]*$/', 'distinct'],
            'dynamic_fields.*.label' => ['required', 'string', 'max:150'],
            'dynamic_fields.*.type' => ['required', 'string', 'in:text,number,date,textarea,select'],
            'dynamic_fields.*.options' => ['nullable', 'string', 'required_if:dynamic_fields.*.type,select'],
            'dynamic_fields.*.required' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $fields = collect($this->input('dynamic_fields', []))->pluck('name')->all();
            $allowed = array_merge($fields, ['sk_number']);
            preg_match_all('/\{\{\s*([a-z][a-z0-9_]*)\s*\}\}/', (string) $this->input('html_template'), $matches);

            foreach (array_unique($matches[1] ?? []) as $placeholder) {
                if (!in_array($placeholder, $allowed, true)) {
                    $validator->errors()->add(
                        'html_template',
                        "Placeholder {{$placeholder}} belum terdaftar sebagai bidang dinamis."
                    );
                }
            }
        });
    }
}
