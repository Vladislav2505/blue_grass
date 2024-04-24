<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StorageType;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerPostRequest;
use App\Models\Partner;
use App\Services\FileService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Throwable;

final class PartnerController extends Controller
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
        $tableHeaders = ['ID', 'Название', 'Дата обновления', 'Активность'];

        $partners = Partner::query()
            ->select(['id', 'slug', 'name', 'updated_at', 'is_active'])
            ->orderBy('updated_at', 'desc')
            ->paginate(self::PER_PAGE);

        return Response::view('admin.partners.index', compact('partners', 'tableHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): HttpResponse
    {
        return Response::view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerPostRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => ['unique:partners'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $data = $request->safe()->toArray();

                $data['image'] = $this->fileService->saveFile($request->file('image'), StorageType::Partners);

                Partner::query()->create($data);
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.partners.index')
                ->withErrors(['error' => __('admin.partner_creation_error')]);
        }

        return Response::redirectToRoute('admin.partners.index')
            ->with(['success' => __('admin.partner_creation_success', ['name' => $request->post('name')])]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner): HttpResponse
    {
        $partner->setAttribute('image', $this->fileService->getFileUrl($partner->image ?? ''));

        return Response::view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerPostRequest $request, Partner $partner): RedirectResponse
    {
        try {
            DB::transaction(function () use ($partner, $request) {
                $file = $request->file('image');
                $oldFile = $partner->image;
                $updatedData = $request->safe()->toArray();

                if ($request->has('image')) {
                    $updatedData['image'] = $this->fileService
                        ->updateFile($file, StorageType::Partners, $oldFile);
                } else {
                    $updatedData['image'] = $oldFile;
                }

                $partner->update($updatedData);
            });
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.partners.index')
                ->withErrors(['error' => __('admin.partner_update_error')]);
        }

        return Response::redirectToRoute('admin.partners.index')
            ->with(['success' => __('admin.partner_update_success', ['name' => $request->post('name')])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        try {
            DB::transaction(function () use ($partner) {
                $partner->deleteOrFail();
                $this->fileService->deleteFile($partner->image ?? '');
            });
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return Response::redirectToRoute('admin.partners.index')
                ->withErrors(['error' => __('admin.partner_delete_error')]);
        }

        return Response::redirectToRoute('admin.partners.index')
            ->with('success', __('admin.partner_delete_success', ['name' => $partner->name]));
    }
}
