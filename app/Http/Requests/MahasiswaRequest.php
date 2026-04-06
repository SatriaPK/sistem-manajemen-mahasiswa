<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MahasiswaRequest extends FormRequest
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
        $id = $this->route('mahasiswa');
        return [
            'nama'     => ['required', 'string', 'max:255'],
            'nim'      => ['required', 'string', 'max:20', 'unique:mahasiswas,nim,' . $id],
            'prodi_id' => ['required', 'exists:prodis,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'     => 'Nama mahasiswa wajib diisi.',
            'nim.required'      => 'NIM wajib diisi.',
            'nim.unique'        => 'NIM sudah terdaftar.',
            'nim.max'           => 'NIM maksimal 20 karakter.',
            'prodi_id.required' => 'Prodi wajib dipilih.',
            'prodi_id.exists'   => 'Prodi tidak valid.',
        ];
    }
}
