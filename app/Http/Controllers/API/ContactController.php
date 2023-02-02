<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactController\SearchByFullnameRequest;
use Illuminate\Http\Request;
use App\Services\API\BaseService;
use App\Services\API\ContactService;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function searchByFullname(SearchByFullnameRequest $request)
    {
        return BaseService::sendResponse(
            ContactService::searchByFullname($request->name, $request->surname, $request->patronymic), 'success'
        );
    }
    public function searchByPhoneNumber(Request $request)
    {
        return BaseService::sendResponse(
            ContactService::searchByPhoneNumber($request->name), 'success'
        );
    }
    public function searchByEmail(Request $request)
    {
        return BaseService::sendResponse(
            ContactService::searchByEmail($request->name), 'success'
        );
    }

    public function getContacts(int $id)
    {
        return BaseService::sendResponse(
            ContactService::getContacts($id), 'success'
        );
    }

    public function deleteContact(int $id): Response
    {
        return ContactService::deleteContact($id) ? BaseService::sendResponse("User:" . $id, 'successfully deleted') : BaseService::sendError("User: " . $id, 'not found');
    }

}
