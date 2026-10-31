<?php

namespace App\Models\ProjectsModel;

use \PDO;

function findAll(PDO $connexion, int $page = 1): array
{
    $limit = 10;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT p.id, p.titre, p.resume, p.dateCreation, p.image,
                   c.pseudo AS creatif_pseudo
            FROM projets p
            INNER JOIN creatifs c ON c.id = p.creatif
            ORDER BY p.dateCreation DESC, p.id DESC
            LIMIT :limit OFFSET :offset;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':limit', $limit, PDO::PARAM_INT);
    $rs->bindValue(':offset', $offset, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function countAll(PDO $connexion): int
{
    $sql = "SELECT COUNT(*) FROM projets";

    return (int) $connexion->query($sql)->fetchColumn();
}
