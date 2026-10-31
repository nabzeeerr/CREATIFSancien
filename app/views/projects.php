
<?php
// Titre utilisé par le header commun.
$titrePage = "Les projets - CREA'TIFS";
?>

<?php require ROOT_PATH . '/app/views/partials/header.php'; ?>
<?php require ROOT_PATH . '/app/views/partials/navbar.php'; ?>

<!-- Bandeau d'introduction -->
<header class="ct-hero">
    <div class="container">
        <h1>Les projets</h1>
        <p>Le meilleur (et le pire, assumé) du design capill'Hair.</p>
    </div>
</header>

<!-- Contenu principal -->
<div class="container ct-content-wrap">
    <div class="row">

        <!-- Liste des projets -->
        <div class="col-lg-8">
            <?php foreach (($projects ?? []) as $project): ?>
                <article class="ct-card">
                    <div class="row">
                        <div class="col-md-4">
                            <img
                                class="img-fluid mb-3 mb-md-0"
                                src="/CREATIFS/template/images/<?= htmlspecialchars($project['image']) ?>"
                                alt="<?= htmlspecialchars($project['titre']) ?>"
                            >
                        </div>

                        <div class="col-md-8">
                            <h3>
                                <a href="/CREATIFS/projects/<?= (int) $project['id'] ?>/<?= htmlspecialchars(slugify($project['titre'])) ?>.html">
                                    <?= htmlspecialchars($project['titre']) ?>
                                </a>
                            </h3>

                            <p class="ct-byline">
                                <?= htmlspecialchars($project['creatif_pseudo']) ?>
                            </p>

                            <p>
                                <?= htmlspecialchars(truncate($project['resume'] ?? '', 100)) ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- Pagination des projets -->
            <nav aria-label="Pagination des projets">
                <ul class="pagination justify-content-center">

                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link"
                            href="?page=<?= $page - 1 ?>">
                                Précédent
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link"
                            href="?page=<?= $page + 1 ?>">
                                Suivant
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </nav>

        </div>

        <?php require ROOT_PATH . '/app/views/partials/sidebar.php'; ?>

    </div>
</div>

<?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>
