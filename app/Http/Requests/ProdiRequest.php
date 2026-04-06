<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProdiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id         = $this->route('prodi');
        $fakultasId = $this->input('fakultas_id');

        $uniqueRule = 'unique:prodis,nama,NULL,id,fakultas_id,' . $fakultasId;
        if ($id) {
            $uniqueRule = 'unique:prodis,nama,' . $id . ',id,fakultas_id,' . $fakultasId;
        }

        return [
            'nama'        => ['required', 'string', 'max:255', $uniqueRule],
            'fakultas_id' => ['required', 'exists:fakultas,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'        => 'Nama prodi wajib diisi.',
            'nama.unique'          => 'Nama prodi sudah terdaftar di fakultas ini.',
            'fakultas_id.required' => 'Fakultas wajib dipilih.',
            'fakultas_id.exists'   => 'Fakultas tidak valid.',
        ];
    }
}
