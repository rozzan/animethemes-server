<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Wiki\Anime\Theme\Entry;

use App\Http\Api\Query\Base\EloquentReadQuery;
use App\Http\Api\Query\Wiki\Anime\Theme\Entry\EntryReadQuery;
use App\Http\Api\Schema\EloquentSchema;
use App\Http\Api\Schema\Wiki\Anime\Theme\EntrySchema;
use App\Http\Requests\Api\Base\EloquentShowRequest;

/**
 * Class EntryShowRequest.
 */
class EntryShowRequest extends EloquentShowRequest
{
    /**
     * Get the schema.
     *
     * @return EloquentSchema
     */
    protected function schema(): EloquentSchema
    {
        return new EntrySchema();
    }

    /**
     * Get the validation API Query.
     *
     * @return EloquentReadQuery
     */
    public function getQuery(): EloquentReadQuery
    {
        return new EntryReadQuery($this->validated());
    }
}
