<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\KoperasiMember;

class UniqueIgnoringCaseAndSubstring implements Rule
{
    public function passes($attribute, $value)
    {
        // Normalize the input value to lowercase
        $normalizedValue = strtolower($value);

        // Check if a record with similar value exists in the database
        return !KoperasiMember::whereRaw('LOWER(nama_anggota) LIKE ?', ["%{$normalizedValue}%"])->exists();
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
