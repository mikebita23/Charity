<?php
class Utilisateur{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $idutilisateur;
    public $pseudo;
	public $mdp;
    public $type_u;
	public $nom_type;
    public $num_loca;
	public $rue;
	public $cpostal;
	public $ville;
	
 
    public function __construct($db){
        $this->conn = $db;
	}
	
    // voir tous
    public function voir_tous(){
        //select all data
        $query = "SELECT `idutilisateur`, `pseudo`, `mdp`, `type_u`,nom_type, `num_loca`,rue,cpostal,ville 
		FROM `utilisateur` user, typeutilisateur t_user, localisation loca WHERE user.type_u = t_user.idtypeutilisateur AND user.num_loca = loca.idlocalisation";
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
		//echo($query);
        return $stmt;
	}
	//voir les details d'un categorie par son id
	function voir_un_id(){
 
		// query to read single record
		$query = "SELECT `idutilisateur`, `pseudo`, `mdp`, `type_u`,nom_type, `num_loca`,rue,cpostal,ville 
		FROM `utilisateur` user, typeutilisateur t_user, localisation loca WHERE user.type_u = t_user.idtypeutilisateur 
		AND user.num_loca = loca.idlocalisation AND user.idutilisateur = ?";
 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
 
		// bind id of product to be updated
		//$stmt->bindParam(1, $this->id_prod);
		$stmt->bindParam(1, $this->idutilisateur);

		//$stmt->bindParam(2, $this->num_article);
        
		// execute query
		$stmt->execute();
		
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// set values to object properties
		$this->idutilisateur = $row['idutilisateur'];
		$this->pseudo = $row['pseudo'];
		$this->mdp = $row['mdp'];
		$this->type_u = $row['type_u'];
		$this->nom_type = $row['nom_type'];
		$this->num_loca = $row['num_loca'];
		$this->rue = $row['rue'];
		$this->cpostal = $row['cpostal'];
		$this->ville = $row['ville'];
        
	}
}
?>