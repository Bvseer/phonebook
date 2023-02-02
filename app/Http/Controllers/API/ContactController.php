<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\API\BaseService;
use App\Services\API\ContactService;

class ContactController extends Controller
{
    public function searchByFullname(Request $request, ContactService $contactService)
    {
        return BaseService::sendResponse(
            ContactService::searchByFullname($request->name, $request->surname, $request->patronymic), 'success'
        );
    }
}
