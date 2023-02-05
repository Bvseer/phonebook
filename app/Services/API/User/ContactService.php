<?php

namespace App\Services\API\User;

use App\Models\Contact;
use App\Models\User;

class ContactService
{
    public static function search(string $search_value)
    {
        return User::join('contacts as c', 'c.user_id', 'users.id')
            ->whereRaw("CONCAT(users.surname, ' ', users.name, ' ', users.patronymic) like '%$search_value%'")
            ->orWhere('users.email', 'like', "%$search_value%")
            ->orWhere('c.email', 'like', "%$search_value%")
            ->orWhere('c.phone_number', 'like', "%$search_value%")
            ->selectRaw("CONCAT(users.surname, ' ', users.name, ' ', users.patronymic) as fullname, c.id as contact_id, users.birthdate, c.phone_number, c.email")
            ->get();
    }

    public static function getUserContacts(int $user_id)
    {
        return Contact::where('user_id', $user_id)->get();
    }

    public static function create(int $user_id, string $phone_number, string $email)
    {
        return Contact::create([
            'user_id' => $user_id,
            'phone_number' => $phone_number,
            'email' => $email,
        ]);
    }

    public static function update(int $contact_id, int $user_id, string $phone_number, string $email)
    {
        return Contact::where([
            'id' => $contact_id,
            'user_id' => $user_id,
        ])->update([
            'phone_number' => $phone_number,
            'email' => $email,
        ]);
    }

    public static function delete(int $contact_id, int $user_id)
    {
        return Contact::where(['id' => $contact_id, 'user_id' => $user_id])->delete();
    }
}
