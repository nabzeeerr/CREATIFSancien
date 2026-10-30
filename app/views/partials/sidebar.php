<div class="col-lg-4">

    <!-- Liste des créa'tifs -->
    <div class="ct-side-card">
        <h5 class="ct-side-card__head">Les créa'tifs</h5>
        <div class="ct-side-card__body">
            <ul class="ct-creatif-list">
                <?php foreach (($creatifs ?? []) as $creatif): ?>
                    <li>
                        <img
                            class="ct-avatar"
                            src="/CREATIFS/template/images/<?= htmlspecialchars($creatif['image']) ?>"
                            alt=""
                        >
                        <span><?= htmlspecialchars($creatif['pseudo']) ?></span>
                        <span class="ct-count"><?= (int) $creatif['nombre_projets'] ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Liste des tags -->
    <div class="ct-side-card">
        <h5 class="ct-side-card__head">Tags</h5>
        <div class="ct-side-card__body">
            <ul class="ct-tags">
                <?php foreach (($tags ?? []) as $tag): ?>
                    <li>
                        <a class="ct-tag" href="#">
                            <?= htmlspecialchars($tag['pseudo']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>
