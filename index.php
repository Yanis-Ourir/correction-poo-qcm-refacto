<?php

require_once 'utils/connexion_database.php';
require_once 'class/Answer.php';
require_once 'class/Question.php';
require_once 'class/Qcm.php';

/**
 * @var PDO $db
 */

$qcm = new Qcm($db);
$qcm->getQuestions();
$qcm->generate();
