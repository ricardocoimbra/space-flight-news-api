<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\Launch;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function list_all(Request $request)
    {
        $articles = Article::with(['launches', 'events'])->paginate($request->per_page);
        if (is_null($articles)) {
            return response()->json(['message' => 'No content'], 204);
        }
        return response()->json($articles, 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $article = Article::create($data);

        foreach ($data['launches'] as $launch) {
            Launch::create([
                '_id' => $launch['id'],
                'provider' => $launch['provider'],
                'article_id' => $article['id'],
            ]);
        }

        foreach ($data['events'] as $event) {
            Event::create([
                '_id' => $event['id'],
                'provider' => $event['provider'],
                'article_id' => $article['id'],
            ]);
        }

        return response()->json(['message' => 'Article created'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $article = Article::with(['launches', 'events'])->find($id);
        if (is_null($article)) {
            return response()->json(['message' => 'No content'], 204);
        }
        return response()->json($article, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $data = $request->all();

        $article->fill($data);
        $article->save();

        $launchesEdit = $article->launches;
        $eventsEdit = $article->events;

        if (count($data['launches']) > 0 ) {
            foreach ($launchesEdit as $key => $elaunch) {
                if (isset($elaunch['id'])) {
                    $launch = Launch::find($elaunch['id']);
                    $data['launches'][$key]['article_id'] = $article->id;
                    $launch->fill($data['launches']);
                    $launch->save();
                }
            }
        }

        if (count($data['events']) > 0 ) {
            foreach ($eventsEdit as $key => $eevent) {
                if (isset($eevent['id'])) {
                    $event = Launch::find($eevent['id']);
                    $data['events'][$key]['article_id'] = $article->id;
                    $event->fill($data['events']);
                    $event->save();
                }
            }
        }

        return response()->json(['message' => 'Article updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if (is_null($article)) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $article->delete();

        return response()->json(['message' => 'No content'], 204);
    }
}
