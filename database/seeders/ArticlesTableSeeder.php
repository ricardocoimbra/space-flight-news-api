<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Event;
use App\Models\Launch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aindaTem = true;
        $start = 0;
        $perPage = 1000;
        while ($aindaTem) {
            $response = Http::acceptJson()
                ->get("https://api.spaceflightnewsapi.net/v3/articles?_limit={$perPage}&_sort=id&_start={$start}")
                ->collect();

            foreach ($response as $value){
                $article = Article::create([
                    "id" => $value['id'],
                    "title" => $value['title'],
                    "url" => $value['url'],
                    "imageUrl" => $value['imageUrl'],
                    "newsSite" => $value['newsSite'],
                    "summary" => $value['summary'],
                    "publishedAt" => $value['publishedAt'],
                    "featured" => $value['featured']
                ]);

                foreach ($value['launches'] as $launch) {
                    Launch::create([
                        '_id' => $launch['id'],
                        'provider' => $launch['provider'],
                        'article_id' => $article['id'],
                    ]);
                }

                foreach ($value['events'] as $event) {
                    Event::create([
                        '_id' => $event['id'],
                        'provider' => $event['provider'],
                        'article_id' => $article['id'],
                    ]);
                }
            }

            if (count($response) == 0 ) {
                $aindaTem = false;
                echo 'Carga de dados finalizada.';
            }
            $start += 1000;
        }
    }
}
