<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Api\Document\Page;

use App\Models\Auth\User;
use App\Models\Document\Page;
use Illuminate\Foundation\Testing\WithoutEvents;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class PageDestroyTest.
 */
class PageDestroyTest extends TestCase
{
    use WithoutEvents;

    /**
     * The Page Destroy Endpoint shall be protected by sanctum.
     *
     * @return void
     */
    public function testProtected(): void
    {
        $page = Page::factory()->createOne();

        $response = $this->delete(route('api.page.destroy', ['page' => $page]));

        $response->assertUnauthorized();
    }

    /**
     * The Page Destroy Endpoint shall delete the page.
     *
     * @return void
     */
    public function testDeleted(): void
    {
        $page = Page::factory()->createOne();

        $user = User::factory()->withPermission('delete page')->createOne();

        Sanctum::actingAs($user);

        $response = $this->delete(route('api.page.destroy', ['page' => $page]));

        $response->assertOk();
        static::assertSoftDeleted($page);
    }
}
