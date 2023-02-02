<?php

namespace App\Services\API;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function delete(int $id)
    {
        return User::where('id', $id)->delete();
    }
}
