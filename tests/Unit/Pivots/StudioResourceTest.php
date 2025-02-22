<?php

declare(strict_types=1);

namespace Tests\Unit\Pivots;

use App\Models\Wiki\ExternalResource;
use App\Models\Wiki\Studio;
use App\Pivots\StudioResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

/**
 * Class StudioResourceTest.
 */
class StudioResourceTest extends TestCase
{
    use WithoutEvents;

    /**
     * A StudioResource shall belong to a Studio.
     *
     * @return void
     */
    public function testStudio(): void
    {
        $studioResource = StudioResource::factory()
            ->for(Studio::factory())
            ->for(ExternalResource::factory(), 'resource')
            ->createOne();

        static::assertInstanceOf(BelongsTo::class, $studioResource->studio());
        static::assertInstanceOf(Studio::class, $studioResource->studio()->first());
    }

    /**
     * A StudioResource shall belong to an ExternalResource.
     *
     * @return void
     */
    public function testResource(): void
    {
        $studioResource = StudioResource::factory()
            ->for(Studio::factory())
            ->for(ExternalResource::factory(), 'resource')
            ->createOne();

        static::assertInstanceOf(BelongsTo::class, $studioResource->resource());
        static::assertInstanceOf(ExternalResource::class, $studioResource->resource()->first());
    }
}
