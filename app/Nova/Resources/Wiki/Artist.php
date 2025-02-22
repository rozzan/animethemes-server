<?php

declare(strict_types=1);

namespace App\Nova\Resources\Wiki;

use App\Models\Wiki\Artist as ArtistModel;
use App\Nova\Lenses\Artist\Image\ArtistCoverLargeLens;
use App\Nova\Lenses\Artist\Image\ArtistCoverSmallLens;
use App\Nova\Lenses\Artist\Resource\ArtistAniDbResourceLens;
use App\Nova\Lenses\Artist\Resource\ArtistAnilistResourceLens;
use App\Nova\Lenses\Artist\Resource\ArtistAnnResourceLens;
use App\Nova\Lenses\Artist\Resource\ArtistMalResourceLens;
use App\Nova\Lenses\Artist\Song\ArtistSongLens;
use App\Nova\Metrics\Artist\ArtistsPerDay;
use App\Nova\Metrics\Artist\NewArtists;
use App\Nova\Resources\BaseResource;
use App\Pivots\ArtistMember;
use App\Pivots\ArtistResource;
use App\Pivots\ArtistSong;
use App\Pivots\BasePivot;
use Exception;
use Illuminate\Validation\Rule;
use Laravel\Nova\Card;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Query\Search\Column;

/**
 * Class Artist.
 */
class Artist extends BaseResource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = ArtistModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = ArtistModel::ATTRIBUTE_NAME;

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string|null
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public function subtitle(): ?string
    {
        return (string) data_get($this, ArtistModel::ATTRIBUTE_SLUG);
    }

    /**
     * The logical group associated with the resource.
     *
     * @return string
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public static function group(): string
    {
        return __('nova.resources.group.wiki');
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public static function label(): string
    {
        return __('nova.resources.label.artists');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public static function singularLabel(): string
    {
        return __('nova.resources.singularLabel.artist');
    }

    /**
     * Get the searchable columns for the resource.
     *
     * @return array
     *
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public static function searchableColumns(): array
    {
        return [
            new Column(ArtistModel::ATTRIBUTE_NAME),
            new Column(ArtistModel::ATTRIBUTE_SLUG),
        ];
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     *
     * @throws Exception
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make(__('nova.fields.base.id'), ArtistModel::ATTRIBUTE_ID)
                ->sortable()
                ->showOnPreview(),

            Text::make(__('nova.fields.artist.name.name'), ArtistModel::ATTRIBUTE_NAME)
                ->sortable()
                ->copyable()
                ->rules(['required', 'max:192'])
                ->help(__('nova.fields.artist.name.help'))
                ->showOnPreview()
                ->filterable(),

            Slug::make(__('nova.fields.artist.slug.name'), ArtistModel::ATTRIBUTE_SLUG)
                ->from(ArtistModel::ATTRIBUTE_NAME)
                ->separator('_')
                ->sortable()
                ->rules(['required', 'max:192', 'alpha_dash'])
                ->updateRules(
                    Rule::unique(ArtistModel::TABLE)
                        ->ignore($request->route('resourceId'), ArtistModel::ATTRIBUTE_ID)
                        ->__toString()
                )
                ->help(__('nova.fields.artist.slug.help'))
                ->showOnPreview(),

            BelongsToMany::make(__('nova.resources.label.songs'), ArtistModel::RELATION_SONGS, Song::class)
                ->searchable()
                ->filterable()
                ->withSubtitles()
                ->showCreateRelationButton()
                ->fields(fn () => [
                    Text::make(__('nova.fields.artist.songs.as.name'), ArtistSong::ATTRIBUTE_AS)
                        ->nullable()
                        ->copyable()
                        ->rules(['nullable', 'max:nova.fields.artist.songs.as.help192'])
                        ->help(__('')),

                    DateTime::make(__('nova.fields.base.created_at'), BasePivot::ATTRIBUTE_CREATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    DateTime::make(__('nova.fields.base.updated_at'), BasePivot::ATTRIBUTE_UPDATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

            BelongsToMany::make(__('nova.resources.label.external_resources'), ArtistModel::RELATION_RESOURCES, ExternalResource::class)
                ->searchable()
                ->filterable()
                ->withSubtitles()
                ->showCreateRelationButton()
                ->fields(fn () => [
                    Text::make(__('nova.fields.artist.resources.as.name'), ArtistResource::ATTRIBUTE_AS)
                        ->nullable()
                        ->copyable()
                        ->rules(['nullable', 'max:192'])
                        ->help(__('nova.fields.artist.resources.as.help')),

                    DateTime::make(__('nova.fields.base.created_at'), BasePivot::ATTRIBUTE_CREATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    DateTime::make(__('nova.fields.base.updated_at'), BasePivot::ATTRIBUTE_UPDATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

            BelongsToMany::make(__('nova.resources.label.members'), ArtistModel::RELATION_MEMBERS, Artist::class)
                ->searchable()
                ->withSubtitles()
                ->showCreateRelationButton()
                ->fields(fn () => [
                    Text::make(__('nova.fields.artist.members.as.name'), ArtistMember::ATTRIBUTE_AS)
                        ->nullable()
                        ->copyable()
                        ->rules(['nullable', 'max:192'])
                        ->help(__('nova.fields.artist.members.as.help')),

                    DateTime::make(__('nova.fields.base.created_at'), BasePivot::ATTRIBUTE_CREATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    DateTime::make(__('nova.fields.base.updated_at'), BasePivot::ATTRIBUTE_UPDATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

            BelongsToMany::make(__('nova.resources.label.groups'), ArtistModel::RELATION_GROUPS, Artist::class)
                ->searchable()
                ->withSubtitles()
                ->showCreateRelationButton()
                ->fields(fn () => [
                    Text::make(__('nova.fields.artist.groups.as.name'), ArtistMember::ATTRIBUTE_AS)
                        ->nullable()
                        ->copyable()
                        ->rules(['nullable', 'max:192'])
                        ->help(__('nova.fields.artist.groups.as.help')),

                    DateTime::make(__('nova.fields.base.created_at'), BasePivot::ATTRIBUTE_CREATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    DateTime::make(__('nova.fields.base.updated_at'), BasePivot::ATTRIBUTE_UPDATED_AT)
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

            BelongsToMany::make(__('nova.resources.label.images'), ArtistModel::RELATION_IMAGES, Image::class)
                ->searchable()
                ->filterable()
                ->withSubtitles()
                ->showCreateRelationButton()
                ->fields(fn () => [
                    DateTime::make(__('nova.fields.base.created_at'), BasePivot::ATTRIBUTE_CREATED_AT)
                        ->hideWhenCreating(),

                    DateTime::make(__('nova.fields.base.updated_at'), BasePivot::ATTRIBUTE_UPDATED_AT)
                        ->hideWhenCreating(),
                ]),

            Panel::make(__('nova.fields.base.timestamps'), $this->timestamps())
                ->collapsable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request): array
    {
        return array_merge(
            parent::cards($request),
            [
                (new NewArtists())->width(Card::ONE_HALF_WIDTH),
                (new ArtistsPerDay())->width(Card::ONE_HALF_WIDTH),
            ]
        );
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request): array
    {
        return array_merge(
            parent::lenses($request),
            [
                new ArtistAniDbResourceLens(),
                new ArtistAnilistResourceLens(),
                new ArtistAnnResourceLens(),
                new ArtistCoverLargeLens(),
                new ArtistCoverSmallLens(),
                new ArtistMalResourceLens(),
                new ArtistSongLens(),
            ]
        );
    }
}
