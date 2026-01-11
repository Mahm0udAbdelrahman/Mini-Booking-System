<?php
namespace App\Enums;

enum UserType: string {
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
    case PROVIDER = 'provider';

    public function label(): string
    {
        return match ($this) {
            self::CUSTOMER => 'Customer',
            self::ADMIN => 'Admin',
            self::PROVIDER => 'Provider',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
