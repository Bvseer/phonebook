<?php

namespace App\Services\API\Admin;

use App\Models\User;

class UserService
{
    public static function delete(int $id)
    {
        return User::where('id', $id)->delete();
    }
}
