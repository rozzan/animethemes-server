<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wiki\Anime\Theme;

use App\Enums\Http\Api\Paging\PaginationStrategy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryDestroyRequest;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryForceDeleteRequest;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryIndexRequest;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryRestoreRequest;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryShowRequest;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryStoreRequest;
use App\Http\Requests\Api\Wiki\Anime\Theme\Entry\EntryUpdateRequest;
use App\Models\Wiki\Anime\Theme\AnimeThemeEntry;
use Illuminate\Http\JsonResponse;
use Spatie\RouteDiscovery\Attributes\Route;

/**
 * Class EntryController.
 */
class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  EntryIndexRequest  $request
     * @return JsonResponse
     */
    #[Route(fullUri: 'animethemeentry', name: 'animethemeentry.index')]
    public function index(EntryIndexRequest $request): JsonResponse
    {
        $query = $request->getQuery();

        if ($query->hasSearchCriteria()) {
            return $query->search(PaginationStrategy::OFFSET())->toResponse($request);
        }

        return $query->index()->toResponse($request);
    }

    /**
     * Store a newly created resource.
     *
     * @param  EntryStoreRequest  $request
     * @return JsonResponse
     */
    #[Route(fullUri: 'animethemeentry', name: 'animethemeentry.store', middleware: 'auth:sanctum')]
    public function store(EntryStoreRequest $request): JsonResponse
    {
        $resource = $request->getQuery()->store();

        return $resource->toResponse($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  EntryShowRequest  $request
     * @param  AnimeThemeEntry  $entry
     * @return JsonResponse
     */
    #[Route(fullUri: 'animethemeentry/{animethemeentry}', name: 'animethemeentry.show')]
    public function show(EntryShowRequest $request, AnimeThemeEntry $entry): JsonResponse
    {
        $resource = $request->getQuery()->show($entry);

        return $resource->toResponse($request);
    }

    /**
     * Update the specified resource.
     *
     * @param  EntryUpdateRequest  $request
     * @param  AnimeThemeEntry  $entry
     * @return JsonResponse
     */
    #[Route(fullUri: 'animethemeentry/{animethemeentry}', name: 'animethemeentry.update', middleware: 'auth:sanctum')]
    public function update(EntryUpdateRequest $request, AnimeThemeEntry $entry): JsonResponse
    {
        $resource = $request->getQuery()->update($entry);

        return $resource->toResponse($request);
    }

    /**
     * Remove the specified resource.
     *
     * @param  EntryDestroyRequest  $request
     * @param  AnimeThemeEntry  $entry
     * @return JsonResponse
     */
    #[Route(fullUri: 'animethemeentry/{animethemeentry}', name: 'animethemeentry.destroy', middleware: 'auth:sanctum')]
    public function destroy(EntryDestroyRequest $request, AnimeThemeEntry $entry): JsonResponse
    {
        $resource = $request->getQuery()->destroy($entry);

        return $resource->toResponse($request);
    }

    /**
     * Restore the specified resource.
     *
     * @param  EntryRestoreRequest  $request
     * @param  AnimeThemeEntry  $entry
     * @return JsonResponse
     */
    #[Route(method: 'patch', fullUri: 'restore/animethemeentry/{animethemeentry}', name: 'animethemeentry.restore', middleware: 'auth:sanctum')]
    public function restore(EntryRestoreRequest $request, AnimeThemeEntry $entry): JsonResponse
    {
        $resource = $request->getQuery()->restore($entry);

        return $resource->toResponse($request);
    }

    /**
     * Hard-delete the specified resource.
     *
     * @param  EntryForceDeleteRequest  $request
     * @param  AnimeThemeEntry  $entry
     * @return JsonResponse
     */
    #[Route(method: 'delete', fullUri: 'forceDelete/animethemeentry/{animethemeentry}', name: 'animethemeentry.forceDelete', middleware: 'auth:sanctum')]
    public function forceDelete(EntryForceDeleteRequest $request, AnimeThemeEntry $entry): JsonResponse
    {
        return $request->getQuery()->forceDelete($entry);
    }
}
