<?php

namespace App\Services\API;

use App\Models\Contact;

class ContactService {
    public static function searchByFullname(string $name, string $surname, string $patronymic) 
    {
        return Contact::where('name', 'like', "%$name%")
            ->orWhere('surname', 'like', "%$surname%")
            ->orWhere('patronymic', 'like', "%$patronymic%")
            ->get();
    }
}