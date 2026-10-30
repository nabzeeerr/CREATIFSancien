<?php

namespace App\Models\TagsModel;

use \PDO;

function findAll(PDO $connexion): array
{
    $sql = "SELECT id, nom
            FROM tags
            ORDER BY nom ASC;";

    $rs = $connexion->query($sql);
    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findAllByProjectId(PDO $connexion, int $projectId): array
{
    $sql = "SELECT t.id, t.nom
            FROM tags t
            INNER JOIN projets_has_tags pht ON pht.tag = t.id
            WHERE pht.projet = :projectId
            ORDER BY t.nom ASC;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':projectId', $projectId, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetchAll(PDO::FETCH_ASSOC);
}

function findAllIdsByProjectId(PDO $connexion, int $projectId): array
{
    $sql = "SELECT tag
            FROM projets_has_tags
            WHERE projet = :projectId;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':projectId', $projectId, PDO::PARAM_INT);
    $rs->execute();

    return array_map('intval', $rs->fetchAll(PDO::FETCH_COLUMN));
}
