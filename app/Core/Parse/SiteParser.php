<?php

namespace App\Core\Parse;

use App\Core\Contracts\IDocLoader;
use App\Models\FailedParse;
use App\Models\Page;
use App\Services\Aws\S3FileManager;
use App\Services\UploadFile\UploadFileManager;

class SiteParser
{
    protected BaseLinkListReader $linkListReader;

    public function __construct(
        string $linkListReaderName,
        private string $siteParserClassName,
        private IDocLoader $docLoader
    ) {
        $this->linkListReader = new $linkListReaderName($docLoader);
    }

    public function parse($pageNum = 15)
    {
        for ($p = 1; $p <= $pageNum; $p++) {
            $links = $this->linkListReader->getLinks($p);

            foreach ($links as $link) {
                try {
                    /** @var BaseSiteParser $pageParser */
                    $pageParser = new $this->siteParserClassName($this->docLoader, $link);

                    $this->createPage($link, $pageParser);
                } catch (\Exception $e) {
                    FailedParse::query()->create(['link' => $link, 'error' => $e->getMessage()]);
                }
            }
        }
    }

    private function createPage(string $originalUrl, BaseSiteParser $parser)
    {
        $pageExists = Page::query()->where('original_url', $originalUrl)->exists();

        if ($pageExists) return;

        $page = new Page;
        $page->title = $parser->title();
        $page->description = $parser->description();
        $page->original_url = $originalUrl;
        $page->published_at = $parser->publishedAt();

        if ($parser->image() !== null)
        {
            $file = UploadFileManager::viaBase64(new S3FileManager, $parser->image())->upload();

            $page->image_key = $file->result() === true ? $file->identifier() : null;
        }

        $page->save();
    }
}
