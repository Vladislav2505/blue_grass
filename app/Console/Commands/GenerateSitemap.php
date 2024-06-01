<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    public function handle(): void
    {
        $sitemap = Sitemap::create();

        // Главная страница
        $sitemap->add(route('main.index.events'));
        $sitemap->add(route('main.index.protocols'));

        // Страницы партнеров
        $sitemap->add(route('main.partners.show'));

        // Страницы галереи
        $sitemap->add(route('main.gallery.show'));

        // Страницы новостей
        $sitemap->add(route('main.news.show'));

        // Страницы детальных мероприятий
        Event::all()->each(function (Event $event) use ($sitemap) {
            $sitemap->add(Url::create("/events/{$event->slug}")
                ->setLastModificationDate($event->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.8));
        });

        // Сохранение карты сайта
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
