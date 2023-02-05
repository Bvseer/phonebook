<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Services\API\BaseService;
use App\Services\API\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function delete(Request $request)
    {
        return BaseService::sendResponse(UserService::delete($request->id), 'successfully deleted');
    }
}

