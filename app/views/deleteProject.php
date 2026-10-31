<?php require ROOT_PATH . '/app/views/partials/header.php'; ?>

<main class="container mt-5">
    <h1>Supprimer un projet</h1>

    <p>
        Tu es sûr de vouloir supprimer
        <strong><?= htmlspecialchars($project['titre']) ?></strong> ?
    </p>

    <form action="/CREATIFS/routers/projectsRouter.php?action=delete" method="POST">
        <input type="hidden" name="id" value="<?= (int) $project['id'] ?>">
        <input type="hidden" name="slug" value="<?= htmlspecialchars(slugify($project['titre'])) ?>">

        <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
        <a href="/CREATIFS/projects" class="btn btn-secondary">Annuler</a>
    </form>
</main>

<?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>