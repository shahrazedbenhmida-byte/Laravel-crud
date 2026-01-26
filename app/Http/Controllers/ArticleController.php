<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{
    

public function index()
{
    $articles = Article::all();
    return view('articles.index', compact('articles'));
}

public function store(Request $request)
{
    Article::create($request->all());
    return redirect()->back();
}

public function destroy(Request $request)
{
    Article::where('titre',$request->titre)->delete();
    return redirect()->back();
}

public function update(Request $request)
{
    Article::where('titre',$request->titre)->update([
                'categorie' => $request->categorie,
                'prix' => $request->prix
            ]);
    return redirect()->back();
}
}
