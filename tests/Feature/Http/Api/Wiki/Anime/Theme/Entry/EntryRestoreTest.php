<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Wiki\Anime\Theme\Entry;

use App\Models\Auth\User;
use App\Models\Wiki\Anime;
use App\Models\Wiki\Anime\AnimeTheme;
use App\Models\Wiki\Anime\Theme\AnimeThemeEntry;
use Illuminate\Foundation\Testing\WithoutEvents;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class EntryRestoreTest.
 */
class EntryRestoreTest extends TestCase
{
    use WithoutEvents;

    /**
     * The Entry Restore Endpoint shall be protected by sanctum.
     *
     * @return void
     */
    public function testProtected(): void
    {
        $entry = AnimeThemeEntry::factory()
            ->for(AnimeTheme::factory()->for(Anime::factory()))
            ->createOne();

        $entry->delete();

        $response = $this->patch(route('api.animethemeentry.restore', ['animethemeentry' => $entry]));

        $response->assertUnauthorized();
    }

    /**
     * The Entry Restore Endpoint shall restore the entry.
     *
     * @return void
     */
    public function testRestored(): void
    {
        $entry = AnimeThemeEntry::factory()
            ->for(AnimeTheme::factory()->for(Anime::factory()))
            ->createOne();

        $entry->delete();

        $user = User::factory()->withPermission('restore anime theme entry')->createOne();

        Sanctum::actingAs($user);

        $response = $this->patch(route('api.animethemeentry.restore', ['animethemeentry' => $entry]));

        $response->assertOk();
        static::assertNotSoftDeleted($entry);
    }
}
