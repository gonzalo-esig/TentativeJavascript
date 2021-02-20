<?php
include('navbar.php');
include_once 'dbconnect.php';
      
 
//check if form is submitted
if (isset($_POST['submit']))
{
    try {
        $request = myConnection()->prepare("UPDATE document SET DOC_STATUS = '2' WHERE ID_DOCUMENT = '" . $_GET['id_doc'] . "'");
        $request->execute();
		$sql = 'select * from document WHERE ID_DOCUMENT ='. $_GET['id_doc'].'';
		
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($result)) {
		$sujet = $row['DOC_NOM'];
		$message = "Votre document ".$row['DOC_NOM']." a été refusé, veuillez contacter l'administrateur pour plus d'informations.";
		}
		
		$sql = 'SELECT PER_EMAIL FROM personnephysique WHERE ID_PERSONNEP = '. $_GET['idpersonne'].'';
		
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_array($result)) {
		$email = $row['PER_EMAIL'];
		}
		mail($email, "Modification dans vos documents déposé : Document " .$sujet , $message);
		header("Location: http://www.esig-sandbox.ch/team20_2_v2/docsClient.php?id=" . $_GET['idpersonne'] . "&c=1&st=success");
		} catch (PDOException $e) {
          header("Location:error.php?message=".$e->getMessage());
          exit();
		}
}
?>