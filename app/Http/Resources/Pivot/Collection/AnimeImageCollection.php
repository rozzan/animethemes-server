<?php

declare(strict_types=1);

namespace App\Http\Resources\Pivot\Collection;

use App\Http\Resources\BaseCollection;
use App\Http\Resources\Pivot\Resource\AnimeImageResource;
use App\Pivots\AnimeImage;
use Illuminate\Http\Request;

/**
 * Class AnimeImageCollection.
 */
class AnimeImageCollection extends BaseCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'animeimages';

    /**
     * Transform the resource into a JSON array.
     *
     * @param  Request  $request
     * @return array
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public function toArray($request): array
    {
        return $this->collection->map(fn (AnimeImage $animeImage) => new AnimeImageResource($animeImage, $this->query))->all();
    }
}
