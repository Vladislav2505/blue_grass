<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

final class ProfileController extends Controller
{
    public function dashboard(): HttpResponse
    {
        return Response::view('profile.dashboard');
    }
}
