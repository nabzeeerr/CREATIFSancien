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