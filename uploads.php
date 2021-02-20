<?php
include('navbar.php');
include_once 'dbconnect.php';

 if ($_SESSION['EST_CLIENT'] == 1){          
    $nom = $_SESSION['PER_NOM'];
    $prenom = $_SESSION['PER_PRENOM'];
	$idpersonne = $_SESSION['ID_PERSONNEP'];
 }            
 
//check if form is submitted
if (isset($_POST['submit']))
{
    $filename = $_FILES['file1']['name'];

    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'doc', 'docx'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            // get last record id
            $sql = 'select max(ID_DOCUMENT) as id from document';
            $result = mysqli_query($con, $sql);
            if (count($result) > 0)
            {
                $row = mysqli_fetch_array($result);
                $filename = ($row['id']+1) . '-' . $filename;
            }
            else
                $filename = '1' . '-' . $filename;

            //set target directory
			$path = "uploads/".$nom.$prenom."/";
                
            $created = @date('Y-m-d H:i:s');
            move_uploaded_file($_FILES['file1']['tmp_name'],($path . $filename));
            
            // insert file details into database
            $sql = "INSERT INTO document(DOC_NOM, DOC_DATEMISEENLIGNE) VALUES('$filename', '$created')";
            mysqli_query($con, $sql);
			
			//Insérer la relation entre le client et le document 
			$iddoc = $row['id'] + 1;
			$sql = "INSERT INTO appartient(ID_DOCUMENT,ID_PERSONNEP) VALUES('$iddoc','$idpersonne')";	
			mysqli_query($con, $sql);
            header("Location: documents.php?st=success");
        }
        else
        {
            header("Location: documents.php?st=error");
        }
    }
    else
        header("Location: documents.php");
}
?>