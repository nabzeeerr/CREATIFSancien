<?php require ROOT_PATH . '/app/views/partials/header.php'; ?>
<?php require ROOT_PATH . '/app/views/partials/navbar.php'; ?>

<header class="ct-hero">
    <div class="container">
        <h1>Modifier un projet</h1>
    </div>
</header>

<main class="container mt-5">
    <form action="/CREATIFS/projects/<?= (int) $project['id'] ?>/<?= urlencode(slugify($project['titre'])) ?>/edit/update.html" method="POST">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control"
                   value="<?= htmlspecialchars($project['titre']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Résumé</label>
            <textarea name="resume" id="resume" class="form-control"><?= htmlspecialchars($project['resume'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="texte" class="form-label">Description</label>
            <textarea name="texte" id="texte" class="form-control"><?= htmlspecialchars($project['texte'] ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Photo</label>
            <input type="text" name="image" id="image" class="form-control"
                   value="<?= htmlspecialchars($project['image'] ?? '') ?>">
        </div>

        <div class="mb-3">
            <label for="creatif" class="form-label">Créatif</label>
            <select name="creatif" id="creatif" class="form-select" required>
                <option value="">Choisir un créatif</option>
                <?php foreach ($creatifs as $creatif): ?>
                    <option value="<?= (int) $creatif['id'] ?>"
                        <?= (int) $project['creatif'] === (int) $creatif['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($creatif['pseudo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tags (facultatif)</label>

            <?php foreach ($tags as $tag): ?>
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="tags[]"
                        id="tag-<?= (int) $tag['id'] ?>"
                        value="<?= (int) $tag['id'] ?>"
                        class="form-check-input"
                        <?= in_array((int) $tag['id'], $projectTags, true) ? 'checked' : '' ?>
                    >
                    <label
                        for="tag-<?= (int) $tag['id'] ?>"
                        class="form-check-label"
                    >
                        <?= htmlspecialchars($tag['nom']) ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="/CREATIFS/projects" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>