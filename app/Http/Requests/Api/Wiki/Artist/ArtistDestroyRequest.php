<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Wiki\Artist;

use App\Http\Api\Query\Base\EloquentWriteQuery;
use App\Http\Api\Query\Wiki\Artist\ArtistWriteQuery;
use App\Http\Api\Schema\EloquentSchema;
use App\Http\Api\Schema\Wiki\ArtistSchema;
use App\Http\Requests\Api\Base\EloquentDestroyRequest;

/**
 * Class ArtistDestroyRequest.
 */
class ArtistDestroyRequest extends EloquentDestroyRequest
{
    /**
     * Get the schema.
     *
     * @return EloquentSchema
     */
    protected function schema(): EloquentSchema
    {
        return new ArtistSchema();
    }

    /**
     * Get the validation API Query.
     *
     * @return EloquentWriteQuery
     */
    public function getQuery(): EloquentWriteQuery
    {
        return new ArtistWriteQuery($this->validated());
    }
}
