<?php

declare(strict_types=1);

namespace Tests\Feature\Events\Pivot;

use App\Events\Pivot\AnimeResource\AnimeResourceCreated;
use App\Events\Pivot\AnimeResource\AnimeResourceDeleted;
use App\Events\Pivot\AnimeResource\AnimeResourceUpdated;
use App\Models\Wiki\Anime;
use App\Models\Wiki\ExternalResource;
use App\Pivots\AnimeResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class AnimeResourceTest.
 */
class AnimeResourceTest extends TestCase
{
    /**
     * When an Anime is attached to a Resource or vice versa, an AnimeResourceCreated event shall be dispatched.
     *
     * @return void
     */
    public function testAnimeResourceCreatedEventDispatched(): void
    {
        Event::fake();

        $anime = Anime::factory()->createOne();
        $resource = ExternalResource::factory()->createOne();

        $anime->resources()->attach($resource);

        Event::assertDispatched(AnimeResourceCreated::class);
    }

    /**
     * When an Anime is detached from a Resource or vice versa, an AnimeResourceDeleted event shall be dispatched.
     *
     * @return void
     */
    public function testAnimeResourceDeletedEventDispatched(): void
    {
        Event::fake();

        $anime = Anime::factory()->createOne();
        $resource = ExternalResource::factory()->createOne();

        $anime->resources()->attach($resource);
        $anime->resources()->detach($resource);

        Event::assertDispatched(AnimeResourceDeleted::class);
    }

    /**
     * When an Anime Resource pivot is updated, an AnimeResourceUpdated event shall be dispatched.
     *
     * @return void
     */
    public function testAnimeResourceUpdatedEventDispatched(): void
    {
        Event::fake();

        $anime = Anime::factory()->createOne();
        $resource = ExternalResource::factory()->createOne();

        $animeResource = AnimeResource::factory()
            ->for($anime, 'anime')
            ->for($resource, 'resource')
            ->createOne();

        $changes = AnimeResource::factory()
            ->for($anime, 'anime')
            ->for($resource, 'resource')
            ->makeOne();

        $animeResource->fill($changes->getAttributes());
        $animeResource->save();

        Event::assertDispatched(AnimeResourceUpdated::class);
    }

    /**
     * The AnimeResourceUpdated event shall contain embed fields.
     *
     * @return void
     */
    public function testAnimeResourceUpdatedEventEmbedFields(): void
    {
        Event::fake();

        $anime = Anime::factory()->createOne();
        $resource = ExternalResource::factory()->createOne();

        $animeResource = AnimeResource::factory()
            ->for($anime, 'anime')
            ->for($resource, 'resource')
            ->createOne();

        $changes = AnimeResource::factory()
            ->for($anime, 'anime')
            ->for($resource, 'resource')
            ->makeOne();

        $animeResource->fill($changes->getAttributes());
        $animeResource->save();

        Event::assertDispatched(AnimeResourceUpdated::class, function (AnimeResourceUpdated $event) {
            $message = $event->getDiscordMessage();

            return ! empty(Arr::get($message->embed, 'fields'));
        });
    }
}
