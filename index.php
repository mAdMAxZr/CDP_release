<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

date_default_timezone_set('UTC');


//------------------------- Init Slim ----------------------------------


$app = new \Slim\Slim(array('debug' => TRUE,
  'templates.path' => 'html',

));

//------------------------- DB Function ---------------------------------


function liste_atelier($atelierID = "none"){

}

function ajout_atelier($titre, $theme, $typeAtel, $laboratoire, $lieu, $duree, $capacite, $horaire){

}

function modification_atelier($id, $titre, $theme, $typeAtel, $laboratoire, $lieu, $duree, $capacite, $horaire){

}

function suppression_atelier($id){

}




/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();


?>