<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Wiki\Series;

use App\Models\Auth\User;
use App\Models\Wiki\Series;
use Illuminate\Foundation\Testing\WithoutEvents;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class SeriesUpdateTest.
 */
class SeriesUpdateTest extends TestCase
{
    use WithoutEvents;

    /**
     * The Series Update Endpoint shall be protected by sanctum.
     *
     * @return void
     */
    public function testProtected(): void
    {
        $series = Series::factory()->createOne();

        $parameters = Series::factory()->raw();

        $response = $this->put(route('api.series.update', ['series' => $series] + $parameters));

        $response->assertUnauthorized();
    }

    /**
     * The Series Update Endpoint shall update a series.
     *
     * @return void
     */
    public function testUpdate(): void
    {
        $series = Series::factory()->createOne();

        $parameters = Series::factory()->raw();

        $user = User::factory()->withPermission('update series')->createOne();

        Sanctum::actingAs($user);

        $response = $this->put(route('api.series.update', ['series' => $series] + $parameters));

        $response->assertOk();
    }
}
