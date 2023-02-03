<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactController\SearchRequest;
use Illuminate\Http\Request;
use App\Services\API\BaseService;
use App\Services\API\ContactService;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function search(SearchRequest $request)
    {
        $contacts = ContactService::search($request->value);
        return $contacts ? BaseService::sendResponse($contacts, 'success') : BaseService::sendError('error', 'no contact found');
    }

    public function get(int $id)
    {
        $contact = ContactService::get($id);
        return $contact ? BaseService::sendResponse($contact, 'success') : BaseService::sendError('error', 'contact not found');
    }

    public function delete(int $id): Response
    {
        return ContactService::delete($id) ? BaseService::sendResponse("User:" . $id, 'successfully deleted') : BaseService::sendError("User: " . $id, 'not found');
    }
}
