<?php

namespace App\Enums;

enum VerificationStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CHANGES_REQUESTED = 'changes_requested';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}