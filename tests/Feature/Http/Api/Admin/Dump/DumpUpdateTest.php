<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Admin\Dump;

use App\Models\Admin\Dump;
use App\Models\Auth\User;
use Illuminate\Foundation\Testing\WithoutEvents;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class DumpUpdateTest.
 */
class DumpUpdateTest extends TestCase
{
    use WithoutEvents;

    /**
     * The Dump Update Endpoint shall be protected by sanctum.
     *
     * @return void
     */
    public function testProtected(): void
    {
        $dump = Dump::factory()->createOne();

        $parameters = Dump::factory()->raw();

        $response = $this->put(route('api.dump.update', ['dump' => $dump] + $parameters));

        $response->assertUnauthorized();
    }

    /**
     * The Dump Update Endpoint shall update a dump.
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $dump = Dump::factory()->createOne();

        $parameters = Dump::factory()->raw();

        $user = User::factory()->withPermission('update dump')->createOne();

        Sanctum::actingAs($user);

        $response = $this->put(route('api.dump.update', ['dump' => $dump] + $parameters));

        $response->assertOk();
    }
}
