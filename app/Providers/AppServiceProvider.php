<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Wiki\Anime\Theme\AnimeThemeEntry;
use App\Models\Wiki\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        Model::handleLazyLoadingViolationUsing(function (Model $model, string $relation) {
            $class = get_class($model);

            Log::info("Attempted to lazy load [$relation] on model [$class]");
        });

        AboutCommand::add('Audios', [
            'Disk' => fn () => Config::get('audio.disk'),
            'Nginx Redirect' => fn () => Config::get('audio.nginx_redirect'),
            'Streaming Method' => fn () => Config::get('audio.streaming_method'),
        ]);

        AboutCommand::add('FFmpeg', [
            'FFmpeg Binary' => fn () => Config::get('laravel-ffmpeg.ffmpeg.binaries'),
            'FFprobe Binary' => fn () => Config::get('laravel-ffmpeg.ffprobe.binaries'),
        ]);

        AboutCommand::add('Flags', [
            'Allow Audio Streams' => fn () => Config::get('flags.allow_audio_streams') ? 'true' : 'false',
            'Allow Discord Notifications' => fn () => Config::get('flags.allow_discord_notifications') ? 'true' : 'false',
            'Allow Video Streams' => fn () => Config::get('flags.allow_video_streams') ? 'true' : 'false',
            'Allow View Recording' => fn () => Config::get('flags.allow_view_recording') ? 'true' : 'false',
        ]);

        AboutCommand::add('Images', [
            'Disk' => fn () => Config::get('image.disk'),
        ]);

        AboutCommand::add('Videos', [
            'Disk' => fn () => Config::get('video.disk'),
            'Encoder Version' => fn () => Config::get('video.encoder_version'),
            'Nginx Redirect' => fn () => Config::get('video.nginx_redirect'),
            'Streaming Method' => fn () => Config::get('video.streaming_method'),
            'Upload Disks' => fn () => implode(',', Config::get('video.upload_disks')),
        ]);

        AboutCommand::add('Wiki', [
            'Donate' => fn () => Config::get('wiki.donate'),
            'FAQ' => fn () => Config::get('wiki.faq'),
            'Featured Entry' => function () {
                /** @var AnimeThemeEntry|null $entry */
                $entry = AnimeThemeEntry::query()->find(Config::get('wiki.featured_entry'));

                return $entry?->getName();
            },
            'Featured Video' => function () {
                /** @var Video|null $video */
                $video = Video::query()->find(Config::get('wiki.featured_video'));

                return $video?->getName();
            },
        ]);
    }
}
