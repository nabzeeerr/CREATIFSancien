<?php

namespace App\Controllers\ProjectsController;

use PDO;

// Affiche la liste des projets.
function index(PDO $connexion): void
{
    $projects = \App\Models\ProjectsModel\findAll($connexion);
    $creatifs = \App\Models\CreatifsModel\findAll($connexion);
    $tags = \App\Models\TagsModel\findAll($connexion);

    require ROOT_PATH . '/app/views/projects.php';
}
