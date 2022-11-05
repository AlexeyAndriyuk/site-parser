<?php

namespace App\Console\Commands;

use App\Core\Parse\RemotePageLoader;
use App\Core\Parse\SiteParser;
use App\Core\Sites\LaravelNews\LaravelNewsLinkReader;
use App\Core\Sites\LaravelNews\LaravelNewsParser;
use Illuminate\Console\Command;

class ParseLaravelNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:laravelnews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command gonna parse site laravel-news';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $parser = new SiteParser(
            LaravelNewsLinkReader::class,
            LaravelNewsParser::class,
            new RemotePageLoader([
                "headers" => [
                    "x-requested-with" => "XMLHttpRequest"
                ]
            ])
        );
        $parser->parse(1);

        $this->comment('Done');

        return Command::SUCCESS;
    }
}
