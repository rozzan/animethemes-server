<?php

declare(strict_types=1);

namespace App\Events\Wiki\Series;

use App\Events\Base\Wiki\WikiDeletedEvent;
use App\Models\Wiki\Series;
use App\Nova\Resources\Wiki\Series as SeriesResource;

/**
 * Class SeriesDeleted.
 *
 * @extends WikiDeletedEvent<Series>
 */
class SeriesDeleted extends WikiDeletedEvent
{
    /**
     * Create a new event instance.
     *
     * @param  Series  $series
     */
    public function __construct(Series $series)
    {
        parent::__construct($series);
    }

    /**
     * Get the model that has fired this event.
     *
     * @return Series
     */
    public function getModel(): Series
    {
        return $this->model;
    }

    /**
     * Get the description for the Discord message payload.
     *
     * @return string
     */
    protected function getDiscordMessageDescription(): string
    {
        return "Series '**{$this->getModel()->getName()}**' has been deleted.";
    }

    /**
     * Get the message for the nova notification.
     *
     * @return string
     */
    protected function getNotificationMessage(): string
    {
        return "Series '{$this->getModel()->getName()}' has been deleted. It will be automatically pruned in one week. Please review.";
    }

    /**
     * Get the URL for the nova notification.
     *
     * @return string
     */
    protected function getNotificationUrl(): string
    {
        $uriKey = SeriesResource::uriKey();

        return "/resources/$uriKey/{$this->getModel()->getKey()}";
    }
}
