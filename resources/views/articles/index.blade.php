<body>
<h1>Bienvenue dans notre page des articles</h1>
<style>
body{
    background-color: blanchedalmond;
}
h1{
    font-weight: bold;
    text-align: center;
    color: red;
    text-decoration: underline;
}
form{
    margin-left: 100px;
}
fieldset{
    width: 300px;
}
div{
    display: inline-block;
    margin-left: 400px;
}
main{
    display: inline-block;
}
legend{
    color: green;
}
#supprimer{
    background-color: red;
}
#ajouter{
    background-color: green;
}
#modifier{
    background-color: yellow;
}
#ta{
    width: 500px;
}
</style>
<main>
<form action="/articles/add" method="post">
    @csrf
    <fieldset>
        <legend>Ajouter un article</legend>
        <table>
            <tr>
                <td><label for="titre">Titre:</label></td>
                <td><input type="text" name="titre"></td>
            </tr>
            <tr>
                <td><label for="categorie">Categorie:</label></td>
                <td><input type="text" name="categorie"></td>
            </tr>
            <tr>
                <td><label for="prix">Prix:</label></td>
                <td><input type="number" name="prix"></td>
            </tr>
            <tr>
                <td><button type="submit" id="ajouter">Ajouter</button></td>
                <td><button type="reset">Annuler</button></td>
            </tr>
        </table>
    </fieldset>
</form>

    <form method="POST" action="/articles/delete">
        @csrf
        @method('DELETE')
        <fieldset>
            <legend>Supprimer un article</legend>
            <table>
                <tr>
                    <td><label for="titre">Titre:</label></td>
                    <td><input type="text" name="titre"></td>
                </tr>
                <tr>
                    <td><button type="submit" id="supprimer">Supprimer</button></td>
                    <td><button type="reset">annuler</button></td>
                </tr>
            </table>
        </fieldset>
    </form>

    <form action="/articles/update" method="post">
    @csrf
    <fieldset>
        <legend>Modifier un article</legend>
        <table>
            <tr>
                <td><label for="titre">Titre:</label></td>
                <td><input type="text" name="titre"></td>
            </tr>
            <tr>
                <td><label for="categorie">Categorie:</label></td>
                <td><input type="text" name="categorie"></td>
            </tr>
            <tr>
                <td><label for="prix">Prix:</label></td>
                <td><input type="number" name="prix" step="0.01"></td>
            </tr>
            <tr>
                <td><button type="submit" id="modifier">Modifier</button></td>
                <td><button type="reset">Annuler</button></td>
            </tr>
        </table>
    </fieldset>
</form>
</main>
<div>
    <table border=solid 2px id="ta">
        <tr>
            <th><h2>Titre</h2></th>
            <th><h2>Catégorie</h2></th>
            <th><h2>Prix</h2></th>
        </tr>
        <tr>
@foreach($articles as $article)
    <td><h2>{{ $article->titre }}</h2></td>
    <td><h3>{{ $article->categorie }}</h3></td>
    <td><h3>{{ $article->prix }}dt</h3></td>
    </tr>
@endforeach
    </table>
</div>
</body>