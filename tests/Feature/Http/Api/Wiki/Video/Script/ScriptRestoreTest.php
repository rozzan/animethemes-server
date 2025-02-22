<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Wiki\Video\Script;

use App\Models\Auth\User;
use App\Models\Wiki\Video\VideoScript;
use Illuminate\Foundation\Testing\WithoutEvents;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class ScriptRestoreTest.
 */
class ScriptRestoreTest extends TestCase
{
    use WithoutEvents;

    /**
     * The Script Restore Endpoint shall be protected by sanctum.
     *
     * @return void
     */
    public function testProtected(): void
    {
        $script = VideoScript::factory()->createOne();

        $script->delete();

        $response = $this->patch(route('api.videoscript.restore', ['videoscript' => $script]));

        $response->assertUnauthorized();
    }

    /**
     * The Script Restore Endpoint shall restore the script.
     *
     * @return void
     */
    public function testRestored(): void
    {
        $script = VideoScript::factory()->createOne();

        $script->delete();

        $user = User::factory()->withPermission('restore video script')->createOne();

        Sanctum::actingAs($user);

        $response = $this->patch(route('api.videoscript.restore', ['videoscript' => $script]));

        $response->assertOk();
        static::assertNotSoftDeleted($script);
    }
}
