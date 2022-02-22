<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Article;
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
        $article = Article::create($request->all());
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
        //$article->makeHidden('id', 'created_at', 'updated_at');
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
        $article->fill($request->all());
        $article->save();
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

        return response()->json('', 204);
    }
}
