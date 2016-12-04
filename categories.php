<?php
// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
    header("Location: mobile/categories.php");
}
?>
<?php
include_once("api/db_conx.php");
$sql = "SELECT id, name FROM recipes ORDER BY Rand() LIMIT 30 ";
$recipes = "";
$query = mysqli_query($db_conx, $sql);
$statusnumrows = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
	$id = $row["id"];
	$name = $row["name"];
	$recipes .= '<li onclick=getRecipe('.$id.')>'.$name.'</li>';
}
?>
<?php
if (isset($_POST['type']) && $_POST['action'] == "find_recipes_list"){
	// Make sure post data is not empty

	// Clean all of the $_POST vars that will interact with the database
	$type = htmlentities($_POST['type']);

    if ($type==="new") {
        $sql = "SELECT * FROM recipes ORDER BY id DESC LIMIT 30";
    } else if ($type==="random") {
        $sql = "SELECT * FROM recipes ORDER BY Rand() DESC LIMIT 30";
    } else {
        $sql = "SELECT * FROM recipes WHERE (category LIKE ('$type%') OR category LIKE ('%$type%') OR category LIKE ('%$type')) LIMIT 30";
    }
    $recipes = "";
    $query = mysqli_query($db_conx, $sql);
    $statusnumrows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $id = $row["id"];
        $name = $row["name"];
        $recipes .= '<li onclick=getRecipe('.$id.')>'.$name.'</li>';
    }
	echo $recipes;
	exit();
}
include_once("getRecipe.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="alternate" media="only screen and (orientation:portrait)" href="mobile/categories.php" >
        <title>Gelly - Categories</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="styles.css" type="text/css">
        <script src="ajax.js"></script>
		<script src="getRecipe.js"></script>
        <script>
            function getRecipesList(type) {              
                //remove the child elements
                var myNode = document.getElementById("recipesList");
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                
                //show loading
                document.getElementById("load").className = "show";
                
                var action = "find_recipes_list";
                var ajax = ajaxObj("POST", "categories.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        //hide loading
                        document.getElementById("load").className = "hide";
                        document.getElementById("recipesList").innerHTML = ajax.responseText;
                    }
                }
                ajax.send("action="+action+"&type="+type);
            }
        </script>
        <style>
            #recipes {
                width: 25%;
                left: 25%;
            }
            #recipe {
                width: 50%;
                left: 50%;
            }
			#share {
				left: 10vw;
			}
            @media screen and (orientation:portrait) {
                #image img {
                    max-height: 50vw;
                    max-width: 40vw;
                }
                #share {
                    width: 45vw;
                    left: -1vw;
                }
                #share span {
                    font-size: 3vw;
                }
            }
        </style>
    </head>
    <?php include_once("header.php");?>
    <body>
        <div id="main">
            <div id="category">
                <div id="inner">
                    <span>Pick a Category:</span>
                    <ul>
						<?php include_once("catergoriesList.php");?>
                    </ul>
                </div>
            </div>
            <div id="recipes">
                <div id="inner">
                    <span>Pick a Recipe:</span>
                    <br><span id="load" class="hide">Loading...</span>
                    <ul id="recipesList">
                        <?php echo $recipes?>
                    </ul>
                </div>
            </div>
            <?php include_once("recipeTemplate.php");?>
        </div>
    </body>
</html>