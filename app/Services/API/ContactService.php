<?php

namespace App\Services\API;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactService
{
    public static function searchByFullname(string $name,string $surname,string $patronymic)
    {
        $contact = Contact::where('name', 'like', "%$name%")
            ->orWhere('surname', 'like', "%$surname%")
            ->orWhere('patronymic', 'like', "%$patronymic%");
//            ->orWhere(DB::raw('CONCAT(name, " ", surname, " ", patronymic)'), 'like', "%$name $surname $patronymic%")
//            ->get();
        dd($contact->toSql(), $contact->getBindings());
    }
    public static function searchByPhoneNumber(string $phone_number)
    {
        return Contact::where('phone_number', 'like', "%$phone_number%")->get();
    }
    public static function searchByEmail(string $email)
    {
        return Contact::where('email', 'like', "%$email%")->get();
    }

    public static function getContacts(int $id)
    {
        return Contact::where('user_id', $id)->get();
    }

    public static function deleteContact(int $id)
    {
        return Contact::where('user_id', $id)->delete();
    }
}
