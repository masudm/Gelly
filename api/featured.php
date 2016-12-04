<?php
	include_once("db_conx.php");
	
	$sql = "SELECT * FROM featured ORDER BY RAND() LIMIT 1";
	$recipes = "";
    $query = mysqli_query($db_conx, $sql);
    $statusnumrows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $id = $row["id"];
        $name = $row["name"];
        $description = $row["description"];
        $img = $row["img"];
            
        $recipes = array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "img" => $img
        );
        echo json_encode($recipes);
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gelly</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel=stylesheet href="styles.css" type="text/css">
	</head>
	<body>
        <div id="main">
            
        </div>
	</body>
</html>