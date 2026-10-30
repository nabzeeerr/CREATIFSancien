<?php

namespace App\Models\ProjectsModel;

use \PDO;

// Récupère les projets avec le pseudo du créa'tif associé.
function findAll(PDO $connexion): array
{
    $sql = "SELECT p.id, p.titre, p.resume, p.dateCreation, p.image,
                   c.pseudo AS creatif_pseudo
            FROM projets p
            INNER JOIN creatifs c ON c.id = p.creatif
            ORDER BY p.dateCreation DESC, p.id DESC;";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
