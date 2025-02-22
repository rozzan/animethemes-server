<?php

declare(strict_types=1);

namespace App\Actions\Models\Wiki\Anime\Image;

use App\Actions\Models\Wiki\Anime\BackfillAnimeImageAction;
use App\Enums\Models\Wiki\ImageFacet;
use App\Enums\Models\Wiki\ResourceSite;
use App\Models\Wiki\ExternalResource;
use App\Models\Wiki\Image;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

/**
 * Class BackfillSmallCoverImageAction.
 */
class BackfillSmallCoverImageAction extends BackfillAnimeImageAction
{
    /**
     * Get the facet to backfill.
     *
     * @return ImageFacet
     */
    protected function getFacet(): ImageFacet
    {
        return ImageFacet::COVER_SMALL();
    }

    /**
     * Query third-party APIs to find Image.
     *
     * @return Image|null
     *
     * @throws RequestException
     */
    protected function getImage(): ?Image
    {
        $anilistResource = $this->getModel()->resources()->firstWhere(ExternalResource::ATTRIBUTE_SITE, ResourceSite::ANILIST);
        if ($anilistResource instanceof ExternalResource) {
            return $this->getAnilistImage($anilistResource);
        }

        return null;
    }

    /**
     * Query Anilist API for large cover image.
     *
     * @param  ExternalResource  $anilistResource
     * @return Image|null
     *
     * @throws RequestException
     */
    protected function getAnilistImage(ExternalResource $anilistResource): ?Image
    {
        $query = '
        query ($id: Int) {
            Media (id: $id, type: ANIME) {
                coverImage {
                    medium
                }
            }
        }
        ';

        $variables = [
            'id' => $anilistResource->external_id,
        ];

        $response = Http::post('https://graphql.anilist.co', [
            'query' => $query,
            'variables' => $variables,
        ])
            ->throw()
            ->json();

        $anilistCoverSmall = Arr::get($response, 'data.Media.coverImage.medium');
        if ($anilistCoverSmall !== null) {
            return $this->createImage($anilistCoverSmall);
        }

        return null;
    }
}
