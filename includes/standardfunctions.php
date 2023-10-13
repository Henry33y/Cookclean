<?

	$CFG_SERVER = "localhost";
	$CFG_USER = "root";
	$CFG_PASSWORD = "";
	$CFG_DATABASE = "buom";

	$mysqli = new mysqli($CFG_SERVER, $CFG_USER, $CFG_PASSWORD, $CFG_DATABASE);
	$conn = new mysqli($CFG_SERVER, $CFG_USER, $CFG_PASSWORD , $CFG_DATABASE);

	/* check connection */
	if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
	}




	function sanitize($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

?>