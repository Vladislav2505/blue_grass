<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StorageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProtocolPostRequest;
use App\Models\Protocol;
use App\Services\FileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

final class ProtocolController extends Controller
{
    public function __construct(
        private readonly FileService $fileService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): HttpResponse
    {
        $tableHeaders = ['ID', 'Название', 'Дата постановления', 'Активность'];

        $protocols = Protocol::query()
            ->select(['id', 'name', 'date', 'is_active'])
            ->orderBy('updated_at', 'desc')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.protocols.index', compact('protocols', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.protocols.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProtocolPostRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                /** @var Protocol $protocol */
                $data = $request->safe()->except('file');

                $data['file'] = $this->fileService
                    ->saveFile($request->file('file'), StorageType::Protocols);

                Protocol::query()->create($data);
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.protocols.index')
                ->withErrors(['error' => __('admin.protocol_creation_error')]);
        }

        return Response::redirectToRoute('admin.protocols.index')
            ->with(['success' => __('admin.protocol_creation_success', ['name' => $request->post('name')])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Protocol $protocol): HttpResponse
    {
        $protocol->setAttribute('file', [
            'filePath' => $protocol->file,
            'fileName' => $this->fileService->getFileName($protocol->file),
        ]);

        return Response::view('admin.protocols.edit', compact('protocol'));
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
