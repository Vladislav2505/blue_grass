<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function download(Request $request, FileService $fileService)
    {
        return $fileService->downloadFile($request->query('path'));
    }
}
