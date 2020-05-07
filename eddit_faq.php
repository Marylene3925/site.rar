<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>modifier une question</title>
</head>
<body>
<div class="partiefaq">

<?php 

echo "<button><a href='index.php #pharmacie'>Retour sur le site</a></button>";
echo "<button><a href='faq.php'>Retour aux questions</a></button>";


?>
</div> 
<?php 
echo "<h2>Modifier la question </h2>";
session_start ();
    
$connection = new PDO('mysql:host=localhost:3308;dbname=WebGroup_test', 'root', '');
    $sql="SELECT * FROM FAQ WHERE id=".$_GET['question']." ";
    $req = $connection->query($sql);   
    
    
    echo "<form action='' method='post' class='form-eddit'>";
    while ($row=$req->fetch()){
    
        echo $row['id']." <input type='textaera' name ='question' class='input-faq' value=' ".$row['question']." '>";
      
        
    }
    echo "<input type='submit' value='modifier'>";
    
    echo "</form>";
    
    // var_dump($_POST);
    
    if(isset($_POST['question'])){
        
        $update="UPDATE FAQ SET question='".$_POST['question']."' WHERE id=".$_GET['question']." ";   
        $stmt = $connection->prepare($update);
        $stmt->execute();
    
    }
    
    if(isset($_POST['question'])) {
        header("Location:faq.php");
        }
           
