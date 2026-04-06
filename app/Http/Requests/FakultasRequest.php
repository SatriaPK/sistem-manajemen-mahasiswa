<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FakultasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('fakulta')?->id;
        return [
            'nama' => ['required', 'string', 'max:255', 'unique:fakultas,nama,' . $id],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama fakultas wajib diisi.',
            'nama.unique'   => 'Nama fakultas sudah terdaftar.',
            'nama.max'      => 'Nama fakultas maksimal 255 karakter.',
        ];
    }
}
