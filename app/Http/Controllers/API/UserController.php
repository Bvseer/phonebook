<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\API\BaseService;
use App\Services\API\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function delete($id)
    {
        return UserService::delete($id) ? BaseService::sendResponse('User: ' . $id, 'successfully deleted') : BaseService::sendError('User: ' . $id, 'not found');
    }
}

