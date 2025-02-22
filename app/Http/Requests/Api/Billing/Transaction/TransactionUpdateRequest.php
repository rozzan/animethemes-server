<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Billing\Transaction;

use App\Http\Api\Query\Base\EloquentWriteQuery;
use App\Http\Api\Query\Billing\Transaction\TransactionWriteQuery;
use App\Http\Api\Schema\Billing\TransactionSchema;
use App\Http\Api\Schema\EloquentSchema;
use App\Http\Requests\Api\Base\EloquentUpdateRequest;

/**
 * Class TransactionUpdateRequest.
 */
class TransactionUpdateRequest extends EloquentUpdateRequest
{
    /**
     * Get the schema.
     *
     * @return EloquentSchema
     */
    protected function schema(): EloquentSchema
    {
        return new TransactionSchema();
    }

    /**
     * Get the validation API Query.
     *
     * @return EloquentWriteQuery
     */
    public function getQuery(): EloquentWriteQuery
    {
        return new TransactionWriteQuery($this->validated());
    }
}
