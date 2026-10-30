
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
                                <?= htmlspecialchars($project['titre']) ?>
                            </h3>

                            <p class="ct-byline">
                                <?= htmlspecialchars($project['creatif_pseudo']) ?>
                            </p>

                            <p>
                                <?= htmlspecialchars($project['resume'] ?? '') ?>
                            </p>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- La pagination sera ajoutée ensuite. -->
        </div>

        <!-- Colonne latérale commune -->
        <?php require ROOT_PATH . '/app/views/partials/sidebar.php'; ?>

    </div>
</div>

<?php require ROOT_PATH . '/app/views/partials/footer.php'; ?>
