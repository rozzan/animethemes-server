<?php

declare(strict_types=1);

namespace App\Policies\List;

use App\Enums\Models\List\PlaylistVisibility;
use App\Models\Auth\User;
use App\Models\List\Playlist;
use App\Models\Wiki\Image;
use App\Pivots\List\PlaylistImage;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Nova\Nova;

/**
 * Class PlaylistPolicy.
 */
class PlaylistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User|null  $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return Nova::whenServing(
            fn (): bool => $user !== null && $user->hasRole('Admin'),
            fn (): bool => $user === null || $user->can('view playlist')
        );
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User|null  $user
     * @param  Playlist  $playlist
     * @return bool
     */
    public function view(?User $user, Playlist $playlist): bool
    {
        return Nova::whenServing(
            fn (): bool => $user !== null && $user->hasRole('Admin'),
            fn (): bool => $user !== null
                    ? $user->can('view playlist') && ($user->getKey() === $playlist->user_id || PlaylistVisibility::PRIVATE()->isNot($playlist->visibility))
                    : PlaylistVisibility::PRIVATE()->isNot($playlist->visibility)
        );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return Nova::whenServing(
            fn (): bool => $user->hasRole('Admin'),
            fn (): bool => $user->can('create playlist')
        );
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Playlist  $playlist
     * @return bool
     */
    public function update(User $user, Playlist $playlist): bool
    {
        return Nova::whenServing(
            fn (): bool => $user->hasRole('Admin'),
            fn (): bool => ! $playlist->trashed() && $user->getKey() === $playlist->user_id && $user->can('update playlist')
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Playlist  $playlist
     * @return bool
     */
    public function delete(User $user, Playlist $playlist): bool
    {
        return Nova::whenServing(
            fn (): bool => $user->hasRole('Admin'),
            fn (): bool => ! $playlist->trashed() && $user->getKey() === $playlist->user_id && $user->can('delete playlist')
        );
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Playlist  $playlist
     * @return bool
     */
    public function restore(User $user, Playlist $playlist): bool
    {
        return Nova::whenServing(
            fn (): bool => $user->hasRole('Admin'),
            fn (): bool => $playlist->trashed() && $user->getKey() === $playlist->user_id && $user->can('restore playlist')
        );
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        return $user->can('force delete playlist');
    }

    /**
     * Determine whether the user can add a track to the playlist.
     *
     * @param  User  $user
     * @return bool
     */
    public function addTrack(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can attach any image to the playlist.
     *
     * @param  User  $user
     * @return bool
     */
    public function attachAnyImage(User $user): bool
    {
        return $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can attach a studio to the image.
     *
     * @param  User  $user
     * @param  Playlist  $playlist
     * @param  Image  $image
     * @return bool
     */
    public function attachImage(User $user, Playlist $playlist, Image $image): bool
    {
        $attached = PlaylistImage::query()
            ->where($image->getKeyName(), $image->getKey())
            ->where($playlist->getKeyName(), $playlist->getKey())
            ->exists();

        return ! $attached && $user->hasRole('Admin');
    }

    /**
     * Determine whether the user can detach an image from the playlist.
     *
     * @param  User  $user
     * @return bool
     */
    public function detachImage(User $user): bool
    {
        return $user->hasRole('Admin');
    }
}
