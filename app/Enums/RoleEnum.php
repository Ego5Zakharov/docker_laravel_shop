<?php

namespace App\Enums;

enum RoleEnum: string
{
    case user = 'user';
    case admin = 'admin';
    case moderator = 'moderator';

    public function name(): string
    {   
        return match ($this) {
            self::user => 'Пользователь',
            self::moderator => 'Модератор',
            self::admin => 'Администратор',
        };
    }
}
