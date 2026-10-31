<?php

// Raccourcit un texte à une longueur maximale sans couper un mot.
function truncate(string $texte, int $limite): string
{
    if (mb_strlen($texte) <= $limite) {
        return $texte;
    }

    // Récupère les caractères jusqu'à la limite.
    $texte = mb_substr($texte, 0, $limite);

    // Coupe au dernier espace pour ne pas couper un mot.
    $position = mb_strrpos($texte, ' ');

    if ($position !== false) {
        $texte = mb_substr($texte, 0, $position);
    }

    // Retire la ponctuation finale avant les trois points.
    $texte = rtrim($texte);
    $texte = preg_replace('/[.,;:!?]+$/u', '', $texte);

    return $texte . '...';
}