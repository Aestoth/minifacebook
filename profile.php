<?php

require_once("connexion.php");

$obj = new Connexion();

if(isset($_GET["id"])){

$data = intval($_GET["id"]);


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<meta charset="utf-8">
</head>
<body>
    <div id="profil_container">
        <p id="searchprofile"><a href="contact_search.php">Chercher</a></p>
        <div id="profile">
            
            <?php
                
                $Personne = $obj->selectPersonneBYid($data);
                echo '<img  id="user_image" src="'.$Personne->URL_Photo.'">';
                echo "<h1>".$Personne->Nom."</h1>";
                echo "<h2>".$Personne->Prenom."</h2>";
                echo "<p>Date de naissance:".$Personne->Date_Naissance."</p>";
                echo "<p>Status:".$Personne->Statut_couple."</p>";

            ?>
            <!--
            <img  id="user_image" src="user.png">
            <h1>User Name</h1>
            <h2>lastname</h2>
            <p>Date de naissance: 1994</p>
            <p>Statut: Célibataire</p>

             -->
        </div>

        <div id="userdetails">
            <div id="hobbies_details">
                <h2>Hobbies</h2>
                <ul>
                    <!--
                    <li>Hiking</li>
                    <li>Cinema</li>
                    <li>Danse</li>
                    <li>Swimming</li>
                    -->
                    

                    <?php

                       $hobbies = $obj->getPersonneHobby($data);

                        

                       foreach($hobbies as $key){

                            echo "<li>".$key->Type."</li>";

                        } 

                    ?>

              
                </ul>
            </div>
            <div id="music_details">
                <h2>Music</h2>
                <ul>
                    <!--
                    <li>Rock</li>
                    <li>R&B</li>
                    <li>Pop</li>
                    <li>Metal</li>
                    -->

                    <?php

                       $music = $obj->getPersonneMusique($data);
                        foreach($music as $key){

                            echo "<li>".$key->Type."</li>";

                        }


                    ?>
                </ul>
            </div>  
        </div>

        
        <div id="user_friends">
            <h2 id="h2_friends">AMIS</h2>
            
           <!--
           <a href="?id=1"><p><img src="user.png" alt="" srcset=""><span class="friendname_1">Vincent berset</span><span class="friendname_2">ami</span></p></a>
            -->
           <?php

           $friends = $obj->getRelationPersonne($data);

            foreach($friends as $key){

                echo "<a href='?id=".$key->id."'><p><img src='".$key->URL_Photo."'><span class='friendname_1'>".$key->Prenom."</span><span class='friendname_2'>".$key->Type."</span></p></a>";

            }

           
        }else{
            echo "page nout found 404";
        }       
        ?>        
        
        </div>  
    </div>
</body>
</html>
