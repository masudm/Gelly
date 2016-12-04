<?php
if (isset($_POST['id']) && $_POST['action'] == "find_recipe"){
	// Make sure post data is not empty

	// Clean all of the $_POST vars that will interact with the database
	$id = preg_replace('/\D/', '', $_POST['id']);

    $sql = "SELECT * FROM recipeInfo WHERE id='$id' LIMIT 1";
    $query = mysqli_query($db_conx, $sql);
    $statusnumrows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $id = $row["id"];
        $name = $row["name"];
        $ingredients = $row["ingredients"];
        $method = $row["method"];
        $img = $row["img"];
        $desc = $row["description"];
        $author = $row["author"];
    }
    $ingredients = explode('|', $ingredients);
    $ing = ""; //the ingredients
    for($i = 0; $i < sizeof($ingredients);$i++) {
        $ing .= '<li>'.$ingredients[$i].'</li>';
    }
    $method = explode('|', $method);
    $meth = ""; //the method
    for($i = 0; $i < sizeof($method);$i++) {
        $meth .= '<li>'.$method[$i].'</li>';
    }

	echo $name."|".$ing."|".$meth."|".$img."|".$id."|".$desc."|".$author;
	exit();
}
?>