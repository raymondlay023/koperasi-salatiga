<?php

namespace App\Enums;

enum TipeBarangEnum: int
{
    case SEMBAKO = 1;
    case KEDELAI = 2;
    case TAHUTEMPE = 3;

    public function labels(): string
    {
        return match($this) {
            self::SEMBAKO => 'Sembako',
            self::KEDELAI => 'Kedelai',
            self::TAHUTEMPE => 'Tahu dan Tempe',
        };
    }

    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
