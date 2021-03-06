<?php

require 'Slim/Slim.php';

\Slim\Slim::registerAutoloader();

date_default_timezone_set('UTC');


//------------------------- Init Slim ----------------------------------


$app = new \Slim\Slim(array('debug' => TRUE,
  'templates.path' => 'html',

));


//------------------------- GET Route ----------------------------------

$app->get('/', function () use ($app){
    $app->render('/home.html', array("liste" => liste_atelier(), "mainBars" => mainBars()));
});

$app->get('/ajout', function () use ($app){
    $app->render('/ajout.html', array("mainBars" => mainBars()));
});

$app->get('/visualisation/:id', function ($id) use ($app){
    $app->render('/visualisation.html', array("data" => liste_atelier($id), "mainBars" => mainBars()));
});

//$app->get('/visualisation')

//------------------------- POST Route ----------------------------------

$app->post('/ajout', function () use ($app){
    ajout_atelier($_POST["titre"], $_POST["theme"], $_POST["type"], $_POST["laboratoire"], $_POST["lieu"], $_POST["duree"], $_POST["capacite"], $_POST["horaire"]);
    $app->redirect('/site1.com/', array());
});

//TODO : change this route to PUT
$app->post('/modifier', function () use ($app){
    $id = $_POST["id"];
    $titre = $_POST["titre"];
    $theme = $_POST["theme"];
    $type = $_POST["type"];
    $laboratoire = $_POST["laboratoire"];
    $lieu = $_POST["lieu"];
    $duree = $_POST["duree"];
    $capacite = $_POST["capacite"];
    $horaire = $_POST["horaire"];
    modification_atelier($id, $titre, $theme, $type, $laboratoire, $lieu, $duree, $capacite, $horaire);
    $app->redirect('/site1.com/', array());
});


$app->post('/supprimer', function () use ($app){
    $id = $_POST["id"];
    suppression_atelier($id);
    $app->redirect('/site1.com/', array());
});
//------------------------- DB Function ---------------------------------


function liste_atelier($atelierID = "none"){
  $mysqli = initDB();
  if($atelierID == "none"){
    $query = "SELECT * FROM ateliers";
  }
  else{
        $query = sprintf("SELECT * FROM ateliers WHERE id=%s", $atelierID);
  }
  $res_query = $mysqli->query($query);
    $res = array();
    while ($row = $res_query->fetch_assoc()) {
      $res[]= $row;
    }
    return $res;
    closeDB();
}

function ajout_atelier($titre, $theme, $typeAtel, $laboratoire, $lieu, $duree, $capacite, $horaire){
  $mysqli = initDB();
  if($mysqli){
    $query = sprintf("INSERT INTO ateliers VALUES (NULL, \"%s\", \"%s\", \"%s\", \"%s\", \"%s\", \"%s\", \"%s\", \"%s\");", $titre, $theme, $typeAtel, $laboratoire, $lieu, $duree, $capacite, $horaire);
    $res_query = mysqli_multi_query($mysqli, $query);
  }
  closeDB($mysqli);//On ferme la database a la fin des fonctions ici tant qu'on a pas d'informations de session
}

function modification_atelier($id, $titre, $theme, $typeAtel, $laboratoire, $lieu, $duree, $capacite, $horaire){
    $mysqli = initDB();
  if($mysqli){
    $query = sprintf("UPDATE ateliers SET titre= \"%s\", theme= \"%s\", typeAtel= \"%s\", laboratoire= \"%s\", lieu= \"%s\", duree= \"%s\", capacite= \"%s\", horaire= \"%s\" WHERE id= %s ;", $titre, $theme, $typeAtel, $laboratoire, $lieu, $duree, $capacite, $horaire, $id);
    $res_query = mysqli_query($mysqli, $query);
  }
  closeDB($mysqli);//On ferme la database a la fin des fonctions ici tant qu'on a pas d'informations de session
}

function suppression_atelier($id){
    $mysqli = initDB();
  if($mysqli){
    $query = sprintf("DELETE FROM ateliers WHERE id= %s", $id);
    $res_query = mysqli_query($mysqli, $query);
  }
  closeDB($mysqli);//On ferme la database a la fin des fonctions ici tant qu'on a pas d'informations de session
}

//------------------------- DB Connexion ---------------------------------


function initDB(){
  $host = "site1.com";
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


function mainBars(){
  echo '<nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li> <a href="/site1.com/">Home</a> </li>
              <li> <a href="/site1.com/ajout">Ajout</a> </li>
            </ul>
          </div>
        </nav>';
}


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();


?>