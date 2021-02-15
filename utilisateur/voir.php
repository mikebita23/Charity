<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/utilisateur.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$utilisateur = new Utilisateur($db);
 
// query products
$stmt = $utilisateur->voir_tous();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $utilisateurs_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $utilisateur_item=array(
            "idutilisateur" => $idutilisateur,
            "pseudo" => $pseudo,
            "mdp" => $mdp,
            "type_u" => $type_u,
            "nom_type" => $nom_type,
            "num_loca" => $num_loca,
            "rue" => $rue,
            "cpostal" => $cpostal,
            "ville" => $ville
        );
 
       	if($idutilisateur!=null){
			array_push($utilisateurs_arr, $utilisateur_item);
		}
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($utilisateurs_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No utilisateur found.")
    );
}