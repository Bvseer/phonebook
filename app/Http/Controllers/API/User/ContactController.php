<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactController\CreateRequest;
use App\Http\Requests\Web\ContactController\DeleteRequest;
use App\Http\Requests\Web\ContactController\GetContactByIdRequest;
use App\Http\Requests\Web\ContactController\GetContactsByUserIdRequest;
use App\Http\Requests\Web\ContactController\SearchRequest;
use App\Http\Requests\Web\ContactController\UpdateRequest;
use App\Services\API\BaseService;
use App\Services\API\User\ContactService;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function search(SearchRequest $request)
    {
        return BaseService::sendResponse(ContactService::search($request->search_value), 'success');
    }

    protected function getUserContacts()
    {
        return ContactService::getUserContacts(Auth::user()->getAuthIdentifier());
    }

    public function bulkCreate(CreateRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        foreach ($request->contacts as $contact) {
            ContactService::create($userId, $contact['phone_number'], $contact['email']);
        }
        return BaseService::sendResponse([], 'successfully created', 201);
    }

    public function bulkUpdate(UpdateRequest $request)
    {
        $userId = Auth::user()->getAuthIdentifier();
        foreach ($request->contacts as $contact) {
            ContactService::update($contact['id'], $userId, $contact['phone_number'], $contact['email']);
        }
        return BaseService::sendResponse([], 'successfully updated');
    }

    public function delete(DeleteRequest $request)
    {
        return BaseService::sendResponse(ContactService::delete($request->contact_id, Auth::user()->getAuthIdentifier()), "successfully deleted");
    }
}
