<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

final class PartnersController extends Controller
{
    protected readonly int $partnersPerPage;

    public function __construct()
    {
        $this->partnersPerPage = 9;
    }

    /**
     * @throws Throwable
     */
    public function show(Request $request)
    {
        $partners = Partner::query()
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->paginate($this->partnersPerPage);

        if ($request->ajax()) {
            return Response::json([
                'content' => view('partials.main.lists.partner-list', compact('partners'))->render(),
                'next' => $partners->hasMorePages(),
            ]);
        }

        return Response::view('main.partners', compact('partners'));
    }
}
