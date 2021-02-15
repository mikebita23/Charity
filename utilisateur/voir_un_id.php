<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/utilisateur.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare utilisateur object
$utilisateur = new Utilisateur($db);
 
// set ID property of record to read
$utilisateur->idutilisateur = isset($_GET['idutilisateur']) ? $_GET['idutilisateur'] : die();

//y aura un bug si on decommente mais  il faut trouver moyen de recuperer le num article
//$utilisateur->article_concerne = isset($_GET['num_article']) ? $_GET['num_article'] : die();

// read the details of utilisateur to be edited
$utilisateur->voir_un_id();
 
if($utilisateur->idutilisateur!=null){
    // create array
    $utilisateur_arr = array(
            "idutilisateur" => $utilisateur->idutilisateur,
            "pseudo" => $utilisateur->pseudo,
            "mdp" => $utilisateur->mdp,
            "type_u" => $utilisateur->type_u,
            "nom_type" => $utilisateur->nom_type,
            "num_loca" => $utilisateur->num_loca,
            "rue" => $utilisateur->rue,
            "cpostal" => $utilisateur->cpostal,
            "ville" => $utilisateur->ville
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($utilisateur_arr);
}
else{
    // set response code - 404 Not found
    http_response_code(404);
    // tell the user utilisateur does not exist
    echo json_encode(array("message" => "the utilisateur does not exist."));
}
?>