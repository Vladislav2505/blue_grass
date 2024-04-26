<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

final class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'ФИО', 'Email', 'Дата регистрации', 'Верифицирован', 'Администратор'];

        $users = User::query()
            ->orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.users.index', compact('users', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): void
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
