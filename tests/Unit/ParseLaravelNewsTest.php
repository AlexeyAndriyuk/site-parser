<?php

namespace Tests\Unit;

use App\Core\Parse\FileLoader;
use App\Core\Sites\LaravelNews\LaravelNewsLinkReader;
use App\Core\Sites\LaravelNews\LaravelNewsParser;
use PHPUnit\Framework\TestCase;

class ParseLaravelNewsTest extends TestCase
{
    /** @test */
    public function check_links_in_correct_order_to_pages()
    {
        $domain = 'https://laravel-news.com';

        $expectedLinks = [
            $domain . '/modern-php-features-explained',
            $domain . '/facades',
            $domain . '/laravel-dom-assertions',
            $domain . '/laravel-9-38-0',
            $domain . '/multi-purpose-value-objects-for-laravel',
            $domain . '/summarize-your-pull-requests-in-seconds-with-what-the-diff',
            $domain . '/laravel-model-flags',
            $domain . '/laravel-9-37-0',
            $domain . '/openai-php-client',
            $domain . '/unlock-the-power-of-tdd'
        ];

        $linksReader = new LaravelNewsLinkReader(
            new FileLoader(__DIR__ . '/stubs/laravel-news-pages-list.html')
        );

        $links = $linksReader->getLinks(1);

        $this->assertCount(10, $links);

        $this->assertEquals($expectedLinks, $links);
    }

    /** @test */
    public function check_first_page_details_from_the_list()
    {
        $pageReader = new LaravelNewsParser(
            new FileLoader(__DIR__ . '/stubs/laravel-news-page-detail.html'),
            'https://just-a-test-link.here'
        );

        $expectedDescription = trim(
            file_get_contents(__DIR__ . '/stubs/page-detail-description.vim')
        );

        $expectedImage = trim(
            file_get_contents(__DIR__ . '/stubs/page-detail-image.vim')
        );

        $this->assertEquals('Modern PHP features explained - PHP 8.0 and 8.1', $pageReader->title());
        $this->assertEquals('October 27th, 2022', $pageReader->publishedAt()->format('F jS, Y'));
        $this->assertEquals($expectedDescription, $pageReader->description());
        $this->assertEquals($expectedImage, $pageReader->image());
    }
}
