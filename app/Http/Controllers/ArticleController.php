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
    $request->validate([
        'titre' => 'required|string|max:255',
        'categorie' => 'required|string|max:255',
        'prix' => 'required|numeric'
    ]);

    Article::create([
        'titre' => $request->titre,
        'categorie' => $request->categorie,
        'prix' => $request->prix
    ]);

    return redirect()->back()->with('success', 'Article ajouté avec succès');
}

public function destroy($id)
{
    // Récupérer l'article par ID
    $article = Article::findOrFail($id);

    // Suppression
    $article->delete();

    return redirect()->back()->with('success', 'Article supprimé avec succès');
}

public function update(Request $request, $id)
{
    // Validation simple
    $request->validate([
        'titre' => 'required|string|max:255',
        'categorie' => 'required|string|max:255',
        'prix' => 'required|numeric'
    ]);

    // Récupérer l'article par ID
    $article = Article::findOrFail($id);

    // Mise à jour
    $article->update([
        'titre' => $request->titre,
        'categorie' => $request->categorie,
        'prix' => $request->prix
    ]);

    return redirect()->back()->with('success', 'Article modifié avec succès');
}
}
