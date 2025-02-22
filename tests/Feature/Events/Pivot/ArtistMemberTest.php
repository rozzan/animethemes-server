<?php

declare(strict_types=1);

namespace Tests\Feature\Events\Pivot;

use App\Events\Pivot\ArtistMember\ArtistMemberCreated;
use App\Events\Pivot\ArtistMember\ArtistMemberDeleted;
use App\Events\Pivot\ArtistMember\ArtistMemberUpdated;
use App\Models\Wiki\Artist;
use App\Pivots\ArtistMember;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class ArtistMemberTest.
 */
class ArtistMemberTest extends TestCase
{
    /**
     * When an Artist is attached to a Member or vice versa, an ArtistMemberCreated event shall be dispatched.
     *
     * @return void
     */
    public function testArtistMemberCreatedEventDispatched(): void
    {
        Event::fake();

        $artist = Artist::factory()->createOne();
        $member = Artist::factory()->createOne();

        $artist->members()->attach($member);

        Event::assertDispatched(ArtistMemberCreated::class);
    }

    /**
     * When an Artist is detached from a Member or vice versa, an ArtistMemberDeleted event shall be dispatched.
     *
     * @return void
     */
    public function testArtistMemberDeletedEventDispatched(): void
    {
        Event::fake();

        $artist = Artist::factory()->createOne();
        $member = Artist::factory()->createOne();

        $artist->members()->attach($member);
        $artist->members()->detach($member);

        Event::assertDispatched(ArtistMemberDeleted::class);
    }

    /**
     * When an Artist Member pivot is updated, an ArtistMemberUpdated event shall be dispatched.
     *
     * @return void
     */
    public function testArtistMemberUpdatedEventDispatched(): void
    {
        Event::fake();

        $artist = Artist::factory()->createOne();
        $member = Artist::factory()->createOne();

        $artistMember = ArtistMember::factory()
            ->for($artist, 'artist')
            ->for($member, 'member')
            ->createOne();

        $changes = ArtistMember::factory()
            ->for($artist, 'artist')
            ->for($member, 'member')
            ->makeOne();

        $artistMember->fill($changes->getAttributes());
        $artistMember->save();

        Event::assertDispatched(ArtistMemberUpdated::class);
    }

    /**
     * The ArtistMemberUpdated event shall contain embed fields.
     *
     * @return void
     */
    public function testArtistMemberUpdatedEventEmbedFields(): void
    {
        Event::fake();

        $artist = Artist::factory()->createOne();
        $member = Artist::factory()->createOne();

        $artistMember = ArtistMember::factory()
            ->for($artist, 'artist')
            ->for($member, 'member')
            ->createOne();

        $changes = ArtistMember::factory()
            ->for($artist, 'artist')
            ->for($member, 'member')
            ->makeOne();

        $artistMember->fill($changes->getAttributes());
        $artistMember->save();

        Event::assertDispatched(ArtistMemberUpdated::class, function (ArtistMemberUpdated $event) {
            $message = $event->getDiscordMessage();

            return ! empty(Arr::get($message->embed, 'fields'));
        });
    }
}
