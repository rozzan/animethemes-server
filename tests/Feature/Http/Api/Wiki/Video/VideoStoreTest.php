<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Wiki\Video;

use App\Enums\Models\Wiki\VideoOverlap;
use App\Enums\Models\Wiki\VideoSource;
use App\Models\Auth\User;
use App\Models\Wiki\Video;
use Illuminate\Foundation\Testing\WithoutEvents;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class VideoStoreTest.
 */
class VideoStoreTest extends TestCase
{
    use WithoutEvents;

    /**
     * The Video Store Endpoint shall be protected by sanctum.
     *
     * @return void
     */
    public function testProtected(): void
    {
        $video = Video::factory()->makeOne();

        $response = $this->post(route('api.video.store', $video->toArray()));

        $response->assertUnauthorized();
    }

    /**
     * The Video Store Endpoint shall require basename, filename, mimetype, path & size fields.
     *
     * @return void
     */
    public function testRequiredFields(): void
    {
        $user = User::factory()->withPermission('create video')->createOne();

        Sanctum::actingAs($user);

        $response = $this->post(route('api.video.store'));

        $response->assertJsonValidationErrors([
            Video::ATTRIBUTE_BASENAME,
            Video::ATTRIBUTE_FILENAME,
            Video::ATTRIBUTE_MIMETYPE,
            Video::ATTRIBUTE_PATH,
            Video::ATTRIBUTE_SIZE,
        ]);
    }

    /**
     * The Video Store Endpoint shall create a video.
     *
     * @return void
     */
    public function testCreate(): void
    {
        $parameters = array_merge(
            Video::factory()->raw(),
            [
                Video::ATTRIBUTE_OVERLAP => VideoOverlap::getRandomInstance()->description,
                Video::ATTRIBUTE_SOURCE => VideoSource::getRandomInstance()->description,
            ]
        );

        $user = User::factory()->withPermission('create video')->createOne();

        Sanctum::actingAs($user);

        $response = $this->post(route('api.video.store', $parameters));

        $response->assertCreated();
        static::assertDatabaseCount(Video::TABLE, 1);
    }
}
