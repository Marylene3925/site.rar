<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>supprimer une question </title>
</head>
<body>
<?php 
session_start ();
    
$connection = new PDO('mysql:host=localhost:3308;dbname=WebGroup_test', 'root', '');
	$update="DELETE FROM FAQ WHERE id=".$_GET['question']." ";
    $stmt = $connection->prepare($update); 
    $stmt->execute();
    //var_dump($update);
	header("Location:faq.php");
	

   