<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case HEAD_MANAGER = 2;
    case INVENTORY = 3;
    case TABUNGAN_PINJAMAN = 4;

    public function labels(): string
    {
        return match($this) {
            self::HEAD_MANAGER => 'Head Manager',
            self::INVENTORY => 'Inventory',
            self::TABUNGAN_PINJAMAN => 'Tabungan dan Pinjaman',
        };
    }

    public function labelPowergridFilter(): string
    {
        return $this->labels();
    }
}
