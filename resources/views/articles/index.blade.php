<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <style>
        h1{
            text-align: center;
        }

        :root {
            --main-color: #198754; /* vert Bootstrap success */
        }

        /* 🌿 Style général */
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        /* 🧾 Carte principale */
        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }

        /* 📊 DataTable */
        table.dataTable {
            border-radius: 10px;
            overflow: hidden;
        }

        /* 🧠 Header table */
        table.dataTable thead {
            background-color: var(--main-color);
            color: white;
        }

        /* 🔘 Boutons action */
        .btn-action {
            padding: 5px 10px;
            margin: 0 3px;
        }

        /* 🪟 Modal */
        .modal-content {
            border-radius: 12px;
        }

        .btn-add-article {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            font-size: 30px;
            border-radius: 50%;
            background-color: var(--main-color);
            color: white;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .btn-add-article:hover {
            transform: scale(1.1);
            background-color: #157347; /* vert plus foncé */
        }
        /* Espace entre la barre de recherche et la table */
        .dataTables_filter {
            margin-bottom: 15px;
        }

        /* Espace global autour de la DataTable */
        .dataTables_wrapper {
            margin-top: 20px;
        }
        
    </style>

</head>

<body>

<h1>Bienvenue dans notre page des articles</h1>
<!-- Modal Ajouter Article -->
<div class="modal fade" id="addArticleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('articles.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Ajouter un article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <label>Titre</label>
          <input type="text" name="titre" class="form-control" required>

          <label class="mt-2">Catégorie</label>
          <input type="text" name="categorie" class="form-control" required>

          <label class="mt-2">Prix</label>
          <input type="number" step="0.01" name="prix" class="form-control" required>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success">Ajouter</button>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Bouton Ajouter fixe -->
<button 
    class="btn btn-add-article"
    data-bs-toggle="modal"
    data-bs-target="#addArticleModal"
>
    +
</button>

<table id="articlesTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Catégorie</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->titre }}</td>
            <td>{{ $article->categorie }}</td>
            <td>{{ $article->prix }}</td>
            <td>
                <!-- Bouton Modifier -->
                <button class="btn btn-warning btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#editModal{{ $article->id }}">
                    Modifier ✏️
                </button>

                <!-- Bouton Supprimer -->
                <button class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $article->id }}">
                    Supprimer 🗑️
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@foreach ($articles as $article)
<div class="modal fade" id="editModal{{ $article->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $article->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel{{ $article->id }}">Modifier l'article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label>Titre :</label>
          <input type="text" name="titre" class="form-control" value="{{ $article->titre }}"><br>
          <label>Catégorie :</label>
          <input type="text" name="categorie" class="form-control" value="{{ $article->categorie }}"><br>
          <label>Prix :</label>
          <input type="number" step="0.01" name="prix" class="form-control" value="{{ $article->prix }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-warning">Modifier</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach ($articles as $article)
<div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $article->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel{{ $article->id }}">Supprimer l'article</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer l'article <strong>{{ $article->titre }}</strong> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Supprimer</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

<script>
$(document).ready(function() {
    $('#articlesTable').DataTable({
        "paging": true,      // Pagination
        "searching": true,   // Barre de recherche
        "ordering": true     // Tri des colonnes
    });
});
</script>

</body>
</html>