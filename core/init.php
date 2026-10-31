<?php

// Chemin absolu vers la racine du projet.
define('ROOT_PATH', dirname(__DIR__));

// Charge les paramètres et ouvre la connexion à la base de données.
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/core/connexion.php';
require_once ROOT_PATH . '/app/helpers/functions.php';