<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'nama_anggota' => 'required|string|max:255',
            'alamat_anggota' => 'required|string|max:255',
            'handphone' => ['required', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,10}$/'],
            'type_id' => 'required|exists:member_types,id',
            'keanggotaan' => 'required|array|min:1',
            'keanggotaan.*' => 'in:on',
        ];
    }

    public function messages()
    {
        return [
            'nama_anggota.required' => 'The nama anggota field is required.',
            'alamat_anggota.required' => 'The alamat anggota field is required.',
            'handphone.required' => 'The handphone field is required.',
            'handphone.regex' => 'Please enter a valid phone number.',
            'type_id.required' => 'The type member field is required.',
            'type_id.exists' => 'The selected type member is invalid.',
            'keanggotaan.required' => 'Please select at least one membership type.',
            'keanggotaan.min' => 'Please select at least one membership type.',
        ];
    }
}
