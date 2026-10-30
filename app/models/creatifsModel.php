<?php

namespace App\Models\CreatifsModel;

use \PDO;

// Récupère les créa'tifs et le nombre de projets associés.
function findAll(PDO $connexion): array
{
    $sql = "SELECT c.id, c.pseudo, c.image, COUNT(p.id) AS nombre_projets
            FROM creatifs c
            LEFT JOIN projets p ON p.creatif = c.id
            GROUP BY c.id, c.pseudo, c.image
            ORDER BY c.pseudo ASC;";

    $rs = $connexion->query($sql);

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}
