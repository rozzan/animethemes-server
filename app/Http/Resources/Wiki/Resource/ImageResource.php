<?php

declare(strict_types=1);

namespace App\Http\Resources\Wiki\Resource;

use App\Http\Api\Query\ReadQuery;
use App\Http\Resources\BaseResource;
use App\Http\Resources\Wiki\Collection\AnimeCollection;
use App\Http\Resources\Wiki\Collection\ArtistCollection;
use App\Http\Resources\Wiki\Collection\StudioCollection;
use App\Models\BaseModel;
use App\Models\Wiki\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

/**
 * Class ImageResource.
 *
 * @mixin Image
 */
class ImageResource extends BaseResource
{
    final public const ATTRIBUTE_LINK = 'link';

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'image';

    /**
     * Create a new resource instance.
     *
     * @param  Image | MissingValue | null  $image
     * @param  ReadQuery  $query
     * @return void
     */
    public function __construct(Image|MissingValue|null $image, ReadQuery $query)
    {
        parent::__construct($image, $query);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public function toArray($request): array
    {
        $result = [];

        if ($this->isAllowedField(BaseResource::ATTRIBUTE_ID)) {
            $result[BaseResource::ATTRIBUTE_ID] = $this->getKey();
        }

        if ($this->isAllowedField(Image::ATTRIBUTE_PATH)) {
            $result[Image::ATTRIBUTE_PATH] = $this->path;
        }

        if ($this->isAllowedField(Image::ATTRIBUTE_FACET)) {
            $result[Image::ATTRIBUTE_FACET] = $this->facet?->description;
        }

        if ($this->isAllowedField(BaseModel::ATTRIBUTE_CREATED_AT)) {
            $result[BaseModel::ATTRIBUTE_CREATED_AT] = $this->created_at;
        }

        if ($this->isAllowedField(BaseModel::ATTRIBUTE_UPDATED_AT)) {
            $result[BaseModel::ATTRIBUTE_UPDATED_AT] = $this->updated_at;
        }

        if ($this->isAllowedField(BaseModel::ATTRIBUTE_DELETED_AT)) {
            $result[BaseModel::ATTRIBUTE_DELETED_AT] = $this->deleted_at;
        }

        if ($this->isAllowedField(ImageResource::ATTRIBUTE_LINK)) {
            $result[ImageResource::ATTRIBUTE_LINK] = Storage::disk(Config::get('image.disk'))->url($this->path);
        }

        $result[Image::RELATION_ARTISTS] = new ArtistCollection($this->whenLoaded(Image::RELATION_ARTISTS), $this->query);
        $result[Image::RELATION_ANIME] = new AnimeCollection($this->whenLoaded(Image::RELATION_ANIME), $this->query);
        $result[Image::RELATION_STUDIOS] = new StudioCollection($this->whenLoaded(Image::RELATION_STUDIOS), $this->query);

        return $result;
    }
}
