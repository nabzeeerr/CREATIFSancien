<?php

require_once __DIR__ . '/../core/init.php';

require_once ROOT_PATH . '/app/models/projectsModel.php';
require_once ROOT_PATH . '/app/models/creatifsModel.php';
require_once ROOT_PATH . '/app/models/tagsModel.php';
require_once ROOT_PATH . '/app/controllers/projectsController.php';


\App\Controllers\ProjectsController\index($connexion);
