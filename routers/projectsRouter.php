<?php
require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/models/creatifsModel.php';
require_once ROOT_PATH . '/app/models/tagsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';

// Détermine l'action demandée.
$action = $_GET['action'] ?? 'index';

if ($action === 'show') {
    // Affiche un projet précis.
    $id = (int) ($_GET['id'] ?? 0);
    $slug = $_GET['slug'] ?? '';
    \App\Controllers\ProjectsController\show($connexion, $id, $slug);
} else {
    // Affiche la liste des projets.
    \App\Controllers\ProjectsController\index($connexion);
}