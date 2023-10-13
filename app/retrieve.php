<?php 

include('../includes/db_config.php');	



$sql = "SELECT * FROM plays WHERE agent = 1 ";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
while ($row=$result->fetch_assoc())
        {
           
            $Item= $row['id'];

            echo "&".$Item;
          
        }   
}
?>