<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class MainController extends Controller
{
    public function events(): HttpResponse
    {
        return Response::view('main.events');
    }
}
