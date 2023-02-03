<?php

namespace App\Services\API;

use App\Models\Contact;
use App\Models\User;

class ContactService
{
    public static function search(string $value)
    {
        return User::leftjoin('contacts as c', 'c.user_id', 'users.id')
            ->whereRaw("CONCAT(users.surname, ' ', users.name, ' ', users.patronymic) like '%$value%'")
            ->orWhere('c.email', 'like', "%$value%")
            ->orWhere('users.email', 'like', "%$value%")
            ->orWhere('c.phone_number', 'like', "%$value%")
            ->get();
    }

    public static function get(int $id)
    {
        return Contact::where('user_id', $id)->get();
    }

    public static function delete(int $id)
    {
        return Contact::where('user_id', $id)->delete();
    }
}
