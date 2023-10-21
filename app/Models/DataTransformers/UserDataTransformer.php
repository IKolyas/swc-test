<?php

namespace App\Models\DataTransformers;

use App\Models\User;

class UserDataTransformer
{
    public static function transformToList(User $user): array
    {
        return [
            'id' => $user->id,
            'fullName' => "{$user->name} {$user->surname}",
        ];
    }
}