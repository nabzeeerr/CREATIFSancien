<?php

namespace App\Controllers\ProjectsController;

use PDO;

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

    require ROOT_PATH . '/app/views/addProject.php';
}

// Enregistre un nouveau projet.
function insert(PDO $connexion): void
{
    // Vérifie que le formulaire a été envoyé en POST.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo "Méthode non autorisée.";
        return;
    }

    // Récupère les données du formulaire.
    $project = [
        'titre' => trim($_POST['titre'] ?? ''),
        'resume' => trim($_POST['resume'] ?? ''),
        'texte' => trim($_POST['texte'] ?? ''),
        'dateCreation' => $_POST['dateCreation'] ?? '',
        'image' => trim($_POST['image'] ?? ''),
        'creatif' => (int) ($_POST['creatif'] ?? 0)
    ];

    // Vérifie les champs obligatoires.
    if ($project['titre'] === '' || $project['dateCreation'] === '' || $project['creatif'] <= 0) {
        http_response_code(400);
        echo "Veuillez remplir les champs obligatoires.";
        return;
    }

    // Insère le projet dans la base de données.
    $success = \App\Models\ProjectsModel\insert($connexion, $project);

    if (!$success) {
        http_response_code(500);
        echo "Impossible d'ajouter le projet.";
        return;
    }

    // Retourne à la liste des projets.
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

    require ROOT_PATH . '/app/views/editProject.php';
}

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

    $project = [
        'titre' => trim($_POST['titre'] ?? ''),
        'resume' => trim($_POST['resume'] ?? ''),
        'texte' => trim($_POST['texte'] ?? ''),
        'dateCreation' => $_POST['dateCreation'] ?? '',
        'image' => trim($_POST['image'] ?? ''),
        'creatif' => (int) ($_POST['creatif'] ?? 0)
    ];

    if ($project['titre'] === '' || $project['dateCreation'] === '' || $project['creatif'] <= 0) {
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