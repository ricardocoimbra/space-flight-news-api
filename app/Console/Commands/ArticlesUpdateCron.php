<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Event;
use App\Models\Launch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ArticlesUpdateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles_update:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @ return int
     */
    public function handle()
    {
        $res = Http::accept('application/json')->get('https://api.spaceflightnewsapi.net/v3/articles?_limit=100')->collect();

        $resOrder = $res->sortBy('id', SORT_ASC);

        $count = 0;
        foreach ($resOrder as $d) {

            $artigoExiste = Article::where('id', $d['id'])->get();

            if (count($artigoExiste->keyBy('id')) <= 0) {
                $article = Article::create($d);
                if ($article) {
                    $count++;
                }
                foreach ($d['launches'] as $launch) {
                    Launch::create([
                        '_id' => $launch['id'],
                        'provider' => $launch['provider'],
                        'article_id' => $article['id'],
                    ]);
                }

                foreach ($d['events'] as $event) {
                    Event::create([
                        '_id' => $event['id'],
                        'provider' => $event['provider'],
                        'article_id' => $article['id'],
                    ]);
                }
            }
        }
        Log::info("Foram adicionados {$count} registros");
        //return 0;
    }
}
