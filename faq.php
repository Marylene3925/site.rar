 
 <link rel='stylesheet'  href='style.css' />

 <!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="style.css">
     <title>faq</title>
 </head>
 <body>
 
 <div class="nav-btn">

 <?php 
 
echo "<button><a href='index.php #pharmacie'>Retour sur le site</a></button>";
echo "<button><a href='add_faq.php'>Ajouter une question</a></button>";


?>
</div> 
<?php 
echo "<h2 class='table_faq'>Récapitulatif des questions et des réponses</h2>";
 session_start ();
     
 $connection = new PDO('mysql:host=localhost:3308;dbname=WebGroup_test', 'root', '');

   $sql="SELECT * FROM FAQ ";
   $req = $connection->query($sql); 
   
   echo "<table class='table_faq'>";
 
   echo "<th>";
 
   echo "<tr>";
   
   while ($row=$req->fetch()){    
    //  var_dump($row);
    
     echo "<td><ul>"."</ul></td>";
     echo "<td><ul>"." ".$row['question']." "." <br>" .$row['reponse']."</ul></td>";  
        
   
     echo "<td><ul><button><a href=eddit_faq.php?question=".$row['id'].">Modifier</a></button></ul></td>";
     echo "<td><ul><button><a href=delete_faq.php?question=".$row['id'].">Supprimer</a></button></ul></td>";
     echo "</tr>";
    
   }
    echo "</table>";    
    
   ?>

 
 
 
 