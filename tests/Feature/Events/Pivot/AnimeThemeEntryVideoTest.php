<?php

declare(strict_types=1);

namespace Tests\Feature\Events\Pivot;

use App\Events\Pivot\AnimeThemeEntryVideo\AnimeThemeEntryVideoCreated;
use App\Events\Pivot\AnimeThemeEntryVideo\AnimeThemeEntryVideoDeleted;
use App\Models\Wiki\Anime;
use App\Models\Wiki\Anime\AnimeTheme;
use App\Models\Wiki\Anime\Theme\AnimeThemeEntry;
use App\Models\Wiki\Video;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class AnimeThemeEntryVideoTest.
 */
class AnimeThemeEntryVideoTest extends TestCase
{
    /**
     * When a Video is attached to an AnimeThemeEntry or vice versa, an AnimeThemeEntryVideoTest event shall be dispatched.
     *
     * @return void
     */
    public function testAnimeThemeEntryVideoCreatedEventDispatched(): void
    {
        Event::fake(AnimeThemeEntryVideoCreated::class);

        $video = Video::factory()->createOne();
        $entry = AnimeThemeEntry::factory()
            ->for(AnimeTheme::factory()->for(Anime::factory()))
            ->createOne();

        $video->animethemeentries()->attach($entry);

        Event::assertDispatched(AnimeThemeEntryVideoCreated::class);
    }

    /**
     * When a Video is detached from an AnimeThemeEntry or vice versa, an AnimeThemeEntryVideoDeleted event shall be dispatched.
     *
     * @return void
     */
    public function testAnimeThemeEntryVideoDeletedEventDispatched(): void
    {
        Event::fake(AnimeThemeEntryVideoDeleted::class);

        $video = Video::factory()->createOne();
        $entry = AnimeThemeEntry::factory()
            ->for(AnimeTheme::factory()->for(Anime::factory()))
            ->createOne();

        $video->animethemeentries()->attach($entry);
        $video->animethemeentries()->detach($entry);

        Event::assertDispatched(AnimeThemeEntryVideoDeleted::class);
    }
}
