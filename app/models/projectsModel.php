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

function findById(PDO $connexion, int $id): array|false
{
    $sql = "SELECT p.*, c.pseudo AS creatif_pseudo
            FROM projets p
            INNER JOIN creatifs c ON c.id = p.creatif
            WHERE p.id = :id;";

    $rs = $connexion->prepare($sql);
    $rs->bindValue(':id', $id, PDO::PARAM_INT);
    $rs->execute();

    return $rs->fetch(PDO::FETCH_ASSOC);
}

function delete(PDO $connexion, int $id): bool
{
    try {
        $connexion->beginTransaction();

        // Supprime les associations entre le projet et ses tags.
        $sqlTags = "DELETE FROM projets_has_tags WHERE projet = :id";
        $rsTags = $connexion->prepare($sqlTags);
        $rsTags->bindValue(':id', $id, PDO::PARAM_INT);
        $rsTags->execute();

        // Supprime le projet.
        $sqlProjet = "DELETE FROM projets WHERE id = :id";
        $rsProjet = $connexion->prepare($sqlProjet);
        $rsProjet->bindValue(':id', $id, PDO::PARAM_INT);
        $rsProjet->execute();

        $connexion->commit();

        return $rsProjet->rowCount() > 0;
    } catch (\Throwable $e) {
        if ($connexion->inTransaction()) {
            $connexion->rollBack();
        }

        return false;
    }
}

// Ajoute un projet et ses associations avec les tags.
function insert(PDO $connexion, array $project): bool
{
    try {
        $connexion->beginTransaction();

        // Insère le projet.
        $sql = "INSERT INTO projets (titre, resume, texte, dateCreation, image, creatif)
                VALUES (:titre, :resume, :texte, :dateCreation, :image, :creatif)";

        $rs = $connexion->prepare($sql);
        $rs->execute([
            ':titre' => $project['titre'],
            ':resume' => $project['resume'],
            ':texte' => $project['texte'],
            ':dateCreation' => $project['dateCreation'],
            ':image' => $project['image'],
            ':creatif' => $project['creatif']
        ]);

        // Récupère l'identifiant du projet créé.
        $projectId = (int) $connexion->lastInsertId();

        // Enregistre les tags sélectionnés, s'il y en a.
        if (!empty($project['tags'])) {
            $sqlTag = "INSERT INTO projets_has_tags (projet, tag)
                       VALUES (:projet, :tag)";

            $rsTag = $connexion->prepare($sqlTag);

            foreach ($project['tags'] as $tagId) {
                $rsTag->execute([
                    ':projet' => $projectId,
                    ':tag' => $tagId
                ]);
            }
        }

        $connexion->commit();

        return true;
    } catch (\Throwable $e) {
        if ($connexion->inTransaction()) {
            $connexion->rollBack();
        }

        return false;
    }
}

// Modifie un projet et remplace ses associations avec les tags.
function update(PDO $connexion, int $id, array $project): bool
{
    try {
        $connexion->beginTransaction();

        // Met à jour les informations du projet.
        $sql = "UPDATE projets
                SET titre = :titre,
                    resume = :resume,
                    texte = :texte,
                    dateCreation = :dateCreation,
                    image = :image,
                    creatif = :creatif
                WHERE id = :id";

        $rs = $connexion->prepare($sql);
        $rs->execute([
            ':titre' => $project['titre'],
            ':resume' => $project['resume'],
            ':texte' => $project['texte'],
            ':dateCreation' => $project['dateCreation'],
            ':image' => $project['image'],
            ':creatif' => $project['creatif'],
            ':id' => $id
        ]);

        // Supprime les anciennes associations.
        $sqlDelete = "DELETE FROM projets_has_tags WHERE projet = :id";
        $rsDelete = $connexion->prepare($sqlDelete);
        $rsDelete->execute([':id' => $id]);

        // Ajoute les nouvelles associations.
        if (!empty($project['tags'])) {
            $sqlTag = "INSERT INTO projets_has_tags (projet, tag)
                       VALUES (:projet, :tag)";

            $rsTag = $connexion->prepare($sqlTag);

            foreach ($project['tags'] as $tagId) {
                $rsTag->execute([
                    ':projet' => $id,
                    ':tag' => $tagId
                ]);
            }
        }

        $connexion->commit();

        return true;
    } catch (\Throwable $e) {
        if ($connexion->inTransaction()) {
            $connexion->rollBack();
        }

        return false;
    }
}