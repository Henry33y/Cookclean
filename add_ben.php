 <?php
// Include the database configuration file
include('includes/db_config.php');	
$statusMsg = '';

$gps = $_POST['gps'];
$town_id = $_POST['town'];
$community = $_POST['community'];

$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$contact = $_POST['contact'];
$alt_contact = $_POST['alt_contact'];
$cookstove = $_POST['model'];
$installment = $_POST['installment'];

$agent_id = $_POST['agent_id'];

// File upload path
$targetDir = "uploads/";
$fileName = $name.'-'.basename($_FILES["idcard"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["idcard"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["idcard"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $conn->query("INSERT into beneficiaries (`fullname`, `gender`, `age`, `contact`, `alt_contact`, `gps`, `photo`, `community`, `status`, `agent_id`, `town_id`, `cookstove`, `installment` ) VALUES ('".$name."','".$gender."','".$age."','".$contact."','".$alt_contact."','".$gps."','".$fileName."','".$community."','".$status."','".$agent_id."','".$town_id."','".$cookstove."','".$installment."')");
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
            }else{
                $statusMsg = "File upload failed, please try again.";
            }  
			
			$statusMsg = "Beneficiary info, photos and GPS data captured successfully.";
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
        // Insert data into database
        $insert = $conn->query("INSERT into beneficiaries (`fullname`, `gender`, `age`, `contact`, `alt_contact`, `gps`, `photo`, `community`, `status`, `agent_id`, `town_id`, `cookstove`, `installment` ) VALUES ('".$name."','".$gender."','".$age."','".$contact."','".$alt_contact."','".$gps."','','".$community."','".$status."','".$agent_id."','".$town_id."','".$cookstove."','".$installment."')");
            if($insert){
                $statusMsg = "Data saved successfully.";
            }else{
                $statusMsg = "Saving failed, please try again.";
            } 
        
}

// Display status message
echo $statusMsg;
          
header("Location: add.php?statusMsg=".$statusMsg);
exit();
?>