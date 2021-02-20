<?php
include('navbar.php');
include_once 'dbconnect.php';
      
 
//check if form is submitted
if (isset($_POST['submit']))
{
    try {
        $request = myConnection()->prepare("DELETE FROM appartient WHERE ID_DOCUMENT = '" . $_GET['id_doc'] . "' AND ID_PERSONNEP = '" . $_GET['idpersonne'] . "'; ");
        $request->execute();
		$request = myConnection()->prepare("DELETE FROM document WHERE ID_DOCUMENT =  '" . $_GET['id_doc'] . "'; ");
        $request->execute();		
		header("Location: http://www.esig-sandbox.ch/team20_2_v2/docsClient.php?id=" . $_GET['idpersonne'] . "&c=1&dl=success");
		} catch (PDOException $e) {
          header("Location:error.php?message=".$e->getMessage());
          exit();
		}
}
?>