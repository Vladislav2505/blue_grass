<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

final class GlobalController extends Controller
{
    public function download(Request $request, FileService $fileService)
    {
        return $fileService->downloadFile($request->query('path'));
    }

    public function logout(Request $request, UserService $userService): RedirectResponse
    {
        $userService->logout($request);

        return Response::redirectToRoute(RouteServiceProvider::HOME);
    }
}
