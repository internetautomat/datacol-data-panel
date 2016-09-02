<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

class AppBaseController extends Controller
{
    public function sendResponse( $result, $message )
    {
        return Response::json( ResponseUtil::makeResponse( $message, $result ) );
    }

}
