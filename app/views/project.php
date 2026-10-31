<?php
$titrePage = htmlspecialchars($project['titre']) . " - CREA'TIFS";
?>

<?php require ROOT_PATH . '/app/views/partials/header.php'; ?>
<?php require ROOT_PATH . '/app/views/partials/navbar.php'; ?>

<header class="ct-hero">
    <div class="container">
        <h1><?= htmlspecialchars($project['titre']) ?></h1>
        <p>Un projet CREA'TIFS</p>
    </div>
</header>

<div class="container ct-content-wrap">
    <div class="row">
        <div class="col-lg-8">
            <article class="ct-card">
                <img
                    class="img-fluid mb-3"
                    src="/CREATIFS/template/images/<?= htmlspecialchars($project['image']) ?>"
                    alt="<?= htmlspecialchars($project['titre']) ?>"
                >

                <p class="ct-byline">
                    Créé par <?= htmlspecialchars($project['creatif_pseudo']) ?>
                </p>

                <p><?= nl2br(htmlspecialchars($project['resume'])) ?></p>

                <div>
                    <?= nl2br(htmlspecialchars($project['texte'])) ?>
                </div>

                <p class="mt-3">
                    Date de création :
                    <?= htmlspecialchars($project['dateCreation']) ?>
                </p>

                <h4>Tags</h4>
                <?php foreach ($tags as $tag): ?>
                    <span class="badge bg-secondary">
                        <?= htmlspecialchars($tag['nom']) ?>
                    </span>
                <?php endforeach; ?>
            </article>
            <div class="mt-3">

                <a class="btn btn-warning"
                    href="/CREATIFS/projects/<?= (int) $project['id'] ?>/<?= urlencode(slugify($project['titre'])) ?>/edit/form.html">
                    Modifier ce projet
                </a>

                <a class="btn btn-danger"
                    href="/CREATIFS/routers/projectsRouter.php?action=confirmDelete&id=<?= (int) $project['id'] ?>&slug=<?= urlencode(slugify($project['titre'])) ?>"
                >
                    Supprimer ce projet
                </a>
                
            </div>
        </div>

        <?php require ROOT_PATH . '/app/views/partials/sidebar.php'; ?>
    </div>
</div>

<?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>