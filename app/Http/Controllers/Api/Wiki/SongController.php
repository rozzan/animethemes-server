<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Wiki;

use App\Enums\Http\Api\Paging\PaginationStrategy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wiki\Song\SongDestroyRequest;
use App\Http\Requests\Api\Wiki\Song\SongForceDeleteRequest;
use App\Http\Requests\Api\Wiki\Song\SongIndexRequest;
use App\Http\Requests\Api\Wiki\Song\SongRestoreRequest;
use App\Http\Requests\Api\Wiki\Song\SongShowRequest;
use App\Http\Requests\Api\Wiki\Song\SongStoreRequest;
use App\Http\Requests\Api\Wiki\Song\SongUpdateRequest;
use App\Models\Wiki\Song;
use Illuminate\Http\JsonResponse;
use Spatie\RouteDiscovery\Attributes\Route;

/**
 * Class SongController.
 */
class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  SongIndexRequest  $request
     * @return JsonResponse
     */
    #[Route(fullUri: 'song', name: 'song.index')]
    public function index(SongIndexRequest $request): JsonResponse
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
     * @param  SongStoreRequest  $request
     * @return JsonResponse
     */
    #[Route(fullUri: 'song', name: 'song.store', middleware: 'auth:sanctum')]
    public function store(SongStoreRequest $request): JsonResponse
    {
        $resource = $request->getQuery()->store();

        return $resource->toResponse($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  SongShowRequest  $request
     * @param  Song  $song
     * @return JsonResponse
     */
    #[Route(fullUri: 'song/{song}', name: 'song.show')]
    public function show(SongShowRequest $request, Song $song): JsonResponse
    {
        $resource = $request->getQuery()->show($song);

        return $resource->toResponse($request);
    }

    /**
     * Update the specified resource.
     *
     * @param  SongUpdateRequest  $request
     * @param  Song  $song
     * @return JsonResponse
     */
    #[Route(fullUri: 'song/{song}', name: 'song.update', middleware: 'auth:sanctum')]
    public function update(SongUpdateRequest $request, Song $song): JsonResponse
    {
        $resource = $request->getQuery()->update($song);

        return $resource->toResponse($request);
    }

    /**
     * Remove the specified resource.
     *
     * @param  SongDestroyRequest  $request
     * @param  Song  $song
     * @return JsonResponse
     */
    #[Route(fullUri: 'song/{song}', name: 'song.destroy', middleware: 'auth:sanctum')]
    public function destroy(SongDestroyRequest $request, Song $song): JsonResponse
    {
        $resource = $request->getQuery()->destroy($song);

        return $resource->toResponse($request);
    }

    /**
     * Restore the specified resource.
     *
     * @param  SongRestoreRequest  $request
     * @param  Song  $song
     * @return JsonResponse
     */
    #[Route(method: 'patch', fullUri: 'restore/song/{song}', name: 'song.restore', middleware: 'auth:sanctum')]
    public function restore(SongRestoreRequest $request, Song $song): JsonResponse
    {
        $resource = $request->getQuery()->restore($song);

        return $resource->toResponse($request);
    }

    /**
     * Hard-delete the specified resource.
     *
     * @param  SongForceDeleteRequest  $request
     * @param  Song  $song
     * @return JsonResponse
     */
    #[Route(method: 'delete', fullUri: 'forceDelete/song/{song}', name: 'song.forceDelete', middleware: 'auth:sanctum')]
    public function forceDelete(SongForceDeleteRequest $request, Song $song): JsonResponse
    {
        return $request->getQuery()->forceDelete($song);
    }
}
