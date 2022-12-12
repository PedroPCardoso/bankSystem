<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\RenderUtil;
class BaseController extends Controller
{
    public function sendResponse($page, $data = null)
    {

         return RenderUtil::makeResponse($page, $data);
    }
    public function sendError($error, $code = 404)
    {
        // return RenderUtil::makeError($error, $code);
    }

}
