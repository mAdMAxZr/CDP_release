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

unction initDB(){
  $host = "localhost";
  $user = "root";
  $password = "root";
  $db = "CDP_BDD";
  $mysqli = NULL;
  try{
    //$mysqli = new mysqli($host, $user, $password, $db);
    $mysqli = mysqli_connect($host,$user,$password,$db) or die('Error connecting to databse');
  }
  catch(Exception $e){
    die("Erreur de Connexion : ".mysqli_connect_error());
  }
  return $mysqli;
}


function closeDB($DB){
  mysqli_close($DB);
}


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();


?>