<?php
include_once("../api/db_conx.php");
$sql = "SELECT DISTINCT id FROM ingredients LIMIT 30";
if(isset($_GET["ing"])){ 
	$ing = htmlspecialchars($_GET['ing']);
	$amount = htmlspecialchars($_GET['amount']);
	include_once("../sqlSelectIngredients.php");
}
if(isset($_GET["category"])){ 
	$category = htmlspecialchars($_GET['category']);
	if ($category==="new") {
        $sql = "SELECT * FROM recipes ORDER BY id DESC LIMIT 30";
    } else if ($category==="random") {
        $sql = "SELECT * FROM recipes ORDER BY Rand() DESC LIMIT 30";
    } else {
        $sql = "SELECT * FROM recipes WHERE (category LIKE ('$category%') OR category LIKE ('%$category%') OR category LIKE ('%$category')) LIMIT 30";
    }
}
$recipes = "";
$query = mysqli_query($db_conx, $sql);
$statusnumrows = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $id = $row["id"];
    $sql = "SELECT name FROM recipes WHERE id='$id'";
    $query2 = mysqli_query($db_conx, $sql);
    $statusnumrows2 = mysqli_num_rows($query2);
    while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
        $name = $row["name"];
        $recipes .= '<a href="../recipe.php?name='.$name.'&id='.$id.'"><li>'.$name.'</li></a>';
    }
}
if ($recipes == "") {
	$recipes = "no recipes found!";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Gelly</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
		<link rel=stylesheet type="text/css" href="../styles.css"/>
		<style>
			#recipes {
				position: initial;
				width: 80vw;
				overflow-y: initial;
				margin: 0 auto;
			}
		</style>
		<script src="../ajax.js"></script>
		<script>
        </script>
	</head>
    <?php include_once("header.php");?>
	<body>
		<div id="main">
			<div id="recipes">
                <div id="inner">
                    <span>Pick a Recipe:</span>
                    <ul id="recipesList">
                        <?php echo $recipes?>
                    </ul>
                </div>
            </div>
		</div>
	</body>
</html>