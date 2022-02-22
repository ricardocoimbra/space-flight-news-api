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
        //$data = Http::accept('application/json')->get('https://api.spaceflightnewsapi.net/v3/articles?_limit=100000&_sort=id')->collect();
        $data = Http::accept('application/json')->get('https://api.spaceflightnewsapi.net/v3/articles')->collect();
        foreach ($data as $d) {
//            Article::create([
//                'title' => $d['title']
//            ]);

            $d['_id'] = $d['id'];

            $validacao = Article::where('_id', $d['_id'])->get();


            if (isset($validacao)) {
                $article = Article::create($d);
                //Log::info('Caiu nesse > ' . $d['id']);
                Log::info('Criou um novo >>> ' . $article);

                foreach ($d['launches'] as $launch) {
                    Launch::create([
                        '_id' => $launch['id'],
                        'provider' => $launch['provider'],
                        'article_id' => $article['id'],
                    ]);
                    //Log::info('Existe launch ' . $launch['id']);
                }

                foreach ($d['events'] as $event) {
                    Event::create([
                        '_id' => $event['id'],
                        'provider' => $event['provider'],
                        'article_id' => $article['id'],
                    ]);
                    //Log::info('Existe event ' . $event['id']);
                }
            }

        }

        //return 0;
    }
}
