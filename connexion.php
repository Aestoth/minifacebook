<?php
class connexion{
    private $connexion;

        public function __construct(){
            $PARAM_hote='localhost';
            $PARAM_port='3306';
            $PARAM_nom_bd='minifacebook';
            $PARAM_utilisateur='adminMiniFacebook';
            $PARAM_mot_passe='minifacebook';

        try{
            $this->connexion = new PDO (
                'mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe);
            }   catch (Exception $e) {
                echo 'Erreur : '.$e->getMessage().'<br />';
                echo 'N° : '.$e->getcode();
            }
        }

    public function getConnexion() {
        return $this->connexion;
        }   

    function insertHobby(string $hobby) {
        
        try{
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Hobby (Type) values (:hobby)");

        $requete_prepare->execute(
            array('hobby' => $hobby));
            return true;   
        }
        catch (Exception $e) {
            return false;
        }
    }

    function insertMusique(string $musique) {
        ;

        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Musique (Type) values (:musique)");

        $requete_prepare->execute(
            array('musique' => $musique));   
    }

    function insertPersonne($nom, $prenom, $URL, $Date, $Statut) {
        
        $requete_prepare = $this->connexion->prepare(
            "INSERT INTO Personne (Nom, Prenom, URL_Photo, Date_Naissance, Statut_couple) values (:Nom, :Prenom, :URL_Photo, :Date_Naissance, :Statut_couple)");

        $requete_prepare->execute(
            array('Nom' => "$nom", 'Prenom' => "$prenom", 'URL_Photo' => "$URL", 'Date_Naissance' => "$Date", 'Statut_couple' => "$Statut"));
    }

    function selectAllHobbies() {
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT Type FROM Hobby");
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;  
    }

    public function selectAllPersonne() {

        $requete_prepare = $this->connexion->prepare (
            "SELECT * FROM Personne");
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;  
    }

    function selectAllMusique() {
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT Type FROM Musique");
        $requete_prepare->execute();
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;  
    }

    function selectPersonneBYid(int $id) {
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT * FROM Personne WHERE Id = :id");
        $requete_prepare->execute(array('id' => $id));
        $resultat=$requete_prepare->fetch(PDO::FETCH_OBJ);
            return $resultat;  
    }

    function selectPersonneByNomPrenomLike($pattern){
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT * FROM Personne WHERE Nom Like :nom OR Prenom Like :prenom");
        $requete_prepare->execute(array("nom"=>"%$pattern%", "prenom"=>"%$pattern%"));
        $resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $resultat;
    }

    function getPersonneHobby($personneID) {
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT Type FROM Hobby h
            INNER JOIN RelationHobby r ON r.Hobby_Id = h.id
            WHERE r.Personne_Id = :id");
        $requete_prepare->execute(array("id" => $personneID));
        $hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $hobbies;
    }

    function getPersonneMusique($personneID) {
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT Type FROM Musique m
            INNER JOIN RelationMusique r ON r.Musique_Id = m.id
            WHERE r.Personne_Id = :id");
        $requete_prepare->execute(array("id" => $personneID));
        $musique = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $musique;
    }

    function getRelationPersonne($personneID) {
        
        $requete_prepare = $this->connexion->prepare (
            "SELECT p.Nom, p.Prenom, rp.Type, p.id, p.URL_Photo  FROM Personne p
            INNER JOIN RelationPersonne rp ON rp.Relation_Id = p.id
            WHERE rp.Personne_Id = :id");
        $requete_prepare->execute(array("id" => $personneID));
        $résultat = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
            return $résultat;
    }

    public function relationPersonne($personne_1, $personne_2,$type){

        $requete_prepare = $this->connexion->prepare(
            
            "INSERT INTO RelationPersonne (Personne_Id, Relation_Id, Type) values (:personne_1, :personne_2, :type)");
       $requete_prepare->execute(array("personne_1"=>$personne_1,"personne_2"=>$personne_2,"type"=>$type));

    }


    public function RelationMusique($personne_id, $musique_id){

        $requete_prepare = $this->connexion->prepare(
            
            "INSERT INTO RelationMusique (Personne_Id, Musique_Id) values (:personne_id, :musique_id)");
       $requete_prepare->execute(array("personne_id"=>$personne_id,"musique_id"=>$musique_id));
    }


    public function RelationHobby($personne_id, $Hobby_id){

        $requete_prepare = $this->connexion->prepare(
            
            "INSERT INTO RelationHobby (Personne_Id, Hobby_Id) values (:personne_id, :Hobby_id)");
       $requete_prepare->execute(array("personne_id"=>$personne_id,"Hobby_id"=>$Hobby_id));
    }

    public function getConnnexion(){

        return $this->connexion;
    }

    public function getLastId(){

        return $this->connexion->lastInsertId();
    }
}

?>


