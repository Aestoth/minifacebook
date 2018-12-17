<?php 

include ('connexion.php');

$appliBD = new Connexion();

if($appliBD->getConnexion() != null) {

    echo "connexion BD réussie". "<br />";
}   
else {
    echo "connexion BD échouée". "<br />";
}
 

// insertHobby("Football");
// insertHobby("Cinema");
// insertHobby("Lire");
// insertHobby("Jeux");
// insertHobby("Fashion");
// insertHobby("Hockey");

// insertMusique("Rock");
// insertMusique("Hip-Hop");
// insertMusique("Metal");
// insertMusique("Jazz");
// insertMusique("R&B");
// insertMusique("POP");

// if(insertHobby ("Poker")) {
//     echo "réussi";
// }
// else {
//     echo "Houston y a un probleme";
// }

/* insertPersonne(Paul, Hemique, "http://www.willsmith.net/", "1968.09.25", marie); */

    
    // $hobbies=selectAllHobbies();
    // echo "<ul>";
    // foreach($hobbies as $Hobby) {
    //    echo  "<li>".$Hobby->Type."</li>"."<br />";
    // }
    // echo "</ul>";

// $music=selectAllMusique();

//     foreach($music as $Musique) {
//         echo "<input type=\"checkbox\" name=\"genre\" valeur=\"Musique\" >"; 
//         echo  "$Musique->Type"."<br />";
// }

// $personID=selectPersonneBYid(6);
// echo $personID->Nom;

// $personne=selectPersonneByNomPrenomLike("au");
//     var_dump ($personne);

    /* $hobbies = $appliBD->getPersonneHobby(6);
    echo "<li>".$hobbies[0]->Type."</li>"."<br />";
    echo "<li>".$hobbies[1]->Type."</li>"."<br />"; */
   
    /* $relations = $appliBD->getRelationPersonne(6);
        foreach($relations as $relation){
            echo "$relation->Nom". "$relation->Prenom". "est mon :" ."$relation->Type"."<br>";
        } */
     $musique = $appliBD->RelationMusique(2, 10);
    
    


?>