<?php

namespace App\Controllers\ProjectsController;

use PDO;

// Enregistre l'image envoyée et retourne son nom.
function uploadImage(): string
{
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        return '';
    }

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        throw new \RuntimeException("Erreur lors de l'envoi de l'image.");
    }

    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($extension, $extensions, true)) {
        throw new \RuntimeException("Format d'image non accepté.");
    }

    if ($extension === 'jpeg') {
        $extension = 'jpg';
    }

    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        throw new \RuntimeException("L'image ne peut pas dépasser 5 Mo.");
    }

    $filename = bin2hex(random_bytes(16)) . '.' . $extension;

    $destination = ROOT_PATH . '/template/images/' . $filename;
    if (!is_dir(dirname($destination)) || !is_writable(dirname($destination))) {
    throw new \RuntimeException("Le dossier template/images est introuvable ou non accessible en écriture.");
    }

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        throw new \RuntimeException("Impossible d'enregistrer l'image.");
    }

    return $filename;
}

// Affiche la liste des projets avec pagination.
function index(PDO $connexion): void
{
    // Récupère le numéro de page depuis l'URL.
    $page = max(1, (int) ($_GET['page'] ?? 1));

    // Compte les projets et calcule le nombre de pages.
    $totalProjects = \App\Models\ProjectsModel\countAll($connexion);
    $totalPages = (int) ceil($totalProjects / 10);

    // Empêche de demander une page inexistante.
    $page = min($page, max(1, $totalPages));

    // Récupère les projets de la page actuelle.
    $projects = \App\Models\ProjectsModel\findAll($connexion, $page);

    // Récupère les données de la colonne latérale.
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);
    $tags = \App\Models\TagsModel\findAll($connexion);

    require ROOT_PATH . '/app/views/projects.php';
}

function show(PDO $connexion, int $id, string $slug): void
{
    $project = \App\Models\ProjectsModel\findById($connexion, $id);

    if (!$project) {
        http_response_code(404);
        echo "Projet introuvable.";
        return;
    }

    $expectedSlug = slugify($project['titre']);

    if ($slug !== $expectedSlug) {
        http_response_code(404);
        echo "URL incorrecte.";
        return;
    }

    $tags = \App\Models\TagsModel\findAllByProjectId($connexion, $id);

    require ROOT_PATH . '/app/views/project.php';
}

function delete(PDO $connexion, int $id, string $slug): void
{
    $project = \App\Models\ProjectsModel\findById($connexion, $id);

    if (!$project || slugify($project['titre']) !== $slug) {
        http_response_code(404);
        echo "Projet introuvable ou URL incorrecte.";
        return;
    }

    $success = \App\Models\ProjectsModel\delete($connexion, $id);

    if (!$success) {
        http_response_code(500);
        echo "Impossible de supprimer le projet.";
        return;
    }

    header('Location: /CREATIFS/projects');
    exit;
}

function confirmDelete(PDO $connexion, int $id, string $slug): void
{

    $project = \App\Models\ProjectsModel\findById($connexion, $id);

    // Vérifie que le projet existe et que le slug est correct.
    if (!$project || slugify($project['titre']) !== $slug) {
        http_response_code(404);
        echo "Projet introuvable ou URL incorrecte.";
        return;
    }

    require ROOT_PATH . '/app/views/deleteProject.php';
}

// Affiche le formulaire d'ajout d'un projet.
function addForm(PDO $connexion): void
{
    // Récupère les créatifs pour la liste déroulante.
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    $tags = \App\Models\TagsModel\findAll($connexion);

    require ROOT_PATH . '/app/views/addProject.php';
}

// Enregistre un nouveau projet.
function insert(PDO $connexion): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo "Méthode non autorisée.";
        return;
    }

    try {
        $image = uploadImage();
    } catch (\RuntimeException $e) {
        http_response_code(400);
        echo $e->getMessage();
        return;
    }

    $project = [
        'titre' => trim($_POST['titre'] ?? ''),
        'resume' => trim($_POST['resume'] ?? ''),
        'texte' => trim($_POST['texte'] ?? ''),
        'dateCreation' => date('Y-m-d'),
        'image' => $image,
        'creatif' => (int) ($_POST['creatif'] ?? 0),
        'tags' => is_array($_POST['tags'] ?? null)
            ? array_values(array_filter(array_map('intval', $_POST['tags']), fn($id) => $id > 0))
            : []
    ];

    if ($project['titre'] === '' || $project['creatif'] <= 0) {
        http_response_code(400);
        echo "Veuillez remplir les champs obligatoires.";
        return;
    }

    $success = \App\Models\ProjectsModel\insert($connexion, $project);

    if (!$success) {
        http_response_code(500);
        echo "Impossible d'ajouter le projet.";
        return;
    }

    header('Location: /CREATIFS/projects');
    exit;
}

function editForm(PDO $connexion, int $id, string $slug): void
{

    $project = \App\Models\ProjectsModel\findById($connexion, $id);

    if (!$project || slugify($project['titre']) !== $slug) {
        http_response_code(404);
        echo "Projet introuvable.";
        return;
    }

    $creatifs = \App\Models\CreatifsModel\findAll($connexion);

    $tags = \App\Models\TagsModel\findAll($connexion);

    $projectTags = \App\Models\TagsModel\findAllIdsByProjectId($connexion, $id);

    require ROOT_PATH . '/app/views/editProject.php';
}

// Enregistre les modifications d'un projet.
function update(PDO $connexion, int $id, string $slug): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo "Méthode non autorisée.";
        return;
    }

    $existingProject = \App\Models\ProjectsModel\findById($connexion, $id);

    if (!$existingProject || slugify($existingProject['titre']) !== $slug) {
        http_response_code(404);
        echo "Projet introuvable.";
        return;
    }

    $image = $existingProject['image'] ?? '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
    
        try {
            $image = uploadImage();
        } catch (\RuntimeException $e) {
            http_response_code(400);
            echo $e->getMessage();
            return;
        }
    }   

    $project = [
        'titre' => trim($_POST['titre'] ?? ''),
        'resume' => trim($_POST['resume'] ?? ''),
        'texte' => trim($_POST['texte'] ?? ''),
        'dateCreation' => $existingProject['dateCreation'],
        'image' => $image,
        'creatif' => (int) ($_POST['creatif'] ?? 0),
        'tags' => is_array($_POST['tags'] ?? null)
            ? array_values(array_filter(array_map('intval', $_POST['tags']), fn($id) => $id > 0))
            : []
    ];

    if ($project['titre'] === '' || $project['creatif'] <= 0) {
        http_response_code(400);
        echo "Veuillez remplir les champs obligatoires.";
        return;
    }

    $success = \App\Models\ProjectsModel\update($connexion, $id, $project);

    if (!$success) {
        http_response_code(500);
        echo "Impossible de modifier le projet.";
        return;
    }

    header('Location: /CREATIFS/projects');
    exit;
}