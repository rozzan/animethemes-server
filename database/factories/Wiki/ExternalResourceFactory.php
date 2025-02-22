<?php

declare(strict_types=1);

namespace Database\Factories\Wiki;

use App\Enums\Models\Wiki\ResourceSite;
use App\Models\Wiki\ExternalResource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ExternalResourceFactory.
 *
 * @method ExternalResource createOne($attributes = [])
 * @method ExternalResource makeOne($attributes = [])
 *
 * @extends Factory<ExternalResource>
 */
class ExternalResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<ExternalResource>
     */
    protected $model = ExternalResource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            ExternalResource::ATTRIBUTE_EXTERNAL_ID => fake()->randomNumber(),
            ExternalResource::ATTRIBUTE_LINK => fake()->url(),
            ExternalResource::ATTRIBUTE_SITE => ResourceSite::getRandomValue(),
        ];
    }
}
