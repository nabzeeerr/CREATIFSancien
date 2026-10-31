<?php
require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/models/creatifsModel.php';
require_once ROOT_PATH . '/app/models/tagsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';

// Détermine l'action demandée.
$action = $_GET['action'] ?? 'index';

if ($action === 'show') {
    
    $id = (int) ($_GET['id'] ?? 0);
    $slug = $_GET['slug'] ?? '';

    \App\Controllers\ProjectsController\show($connexion, $id, $slug);
} 

elseif ($action === 'confirmDelete') {
    // Affiche la confirmation de suppression.
    $id = (int) ($_GET['id'] ?? 0);
    $slug = $_GET['slug'] ?? '';

    \App\Controllers\ProjectsController\confirmDelete($connexion, $id, $slug);

} 

elseif ($action === 'delete') {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo "Méthode non autorisée.";
        exit;
    }

    $id = (int) ($_POST['id'] ?? 0);
    $slug = $_POST['slug'] ?? '';

    \App\Controllers\ProjectsController\delete($connexion, $id, $slug);

} 

elseif ($action === 'addForm') {
    // Affiche le formulaire d'ajout.
    \App\Controllers\ProjectsController\addForm($connexion);

} 

elseif ($action === 'insert') {
    // Enregistre un nouveau projet.
    \App\Controllers\ProjectsController\insert($connexion);

} 

elseif ($action === 'editForm') {
    // Affiche le formulaire de modification.
    $id = (int) ($_GET['id'] ?? 0);
    $slug = $_GET['slug'] ?? '';

    \App\Controllers\ProjectsController\editForm($connexion, $id, $slug);

} 
elseif ($action === 'update') {
    // Enregistre les modifications.
    $id = (int) ($_GET['id'] ?? 0);
    $slug = $_GET['slug'] ?? '';

    \App\Controllers\ProjectsController\update($connexion, $id, $slug);
}
else {

    \App\Controllers\ProjectsController\index($connexion);
}