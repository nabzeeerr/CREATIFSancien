<?php require ROOT_PATH . '/app/views/partials/header.php'; ?>
<?php require ROOT_PATH . '/app/views/partials/navbar.php'; ?>

<header class="ct-hero">
    <div class="container">
        <h1>Ajouter un projet</h1>
    </div>
</header>

<main class="container mt-5">
    <form action="/CREATIFS/projects/add/insert.html" method="POST">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Résumé</label>
            <textarea name="resume" id="resume" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="texte" class="form-label">Texte</label>
            <textarea name="texte" id="texte" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="dateCreation" class="form-label">Date de création</label>
            <input type="date" name="dateCreation" id="dateCreation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Nom de l'image</label>
            <input type="text" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="creatif" class="form-label">Créatif</label>
            <select name="creatif" id="creatif" class="form-select" required>
                <option value="">Choisir un créatif</option>

                <?php foreach ($creatifs as $creatif): ?>
                    <option value="<?= (int) $creatif['id'] ?>">
                        <?= htmlspecialchars($creatif['pseudo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter le projet</button>
        <a href="/CREATIFS/projects" class="btn btn-secondary">Annuler</a>

    </form>
</main>

<?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>