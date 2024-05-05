<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

final class GlobalController extends Controller
{
    public function download(Request $request, FileService $fileService)
    {
        return $fileService->downloadFile($request->query('path'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return Response::redirectToRoute(RouteServiceProvider::HOME);
    }
}
