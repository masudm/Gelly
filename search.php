<?php
// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
?>
<?php
	include_once("api/db_conx.php");
$recipes = "";
$q= "";
	if(isset($_GET["q"])){
		$query = htmlspecialchars($_GET['q']);
		$q = $query;
        if (strlen($query) < 3) {
            header("Location: search.php");
            exit();
        }
		$sql = "SELECT * FROM recipeInfo WHERE (name LIKE ('$query%') OR name LIKE ('%$query%') OR name LIKE ('%$query'))";
		$recipes = "";
		$query = mysqli_query($db_conx, $sql);
		$statusnumrows = mysqli_num_rows($query);
		while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$id = $row["id"];
			$name = $row["name"];
			$recipes .= '<li onclick=getRecipe('.$id.')>'.$name.'</li>';
		}
        // Any mobile device (phones or tablets).
        if ( $detect->isMobile() ) {
            header("Location: mobile/search.php?q=".$q);
        }
	} else {
        // Any mobile device (phones or tablets).
        if ( $detect->isMobile() ) {
            header("Location: mobile/search.php");
        }
    }
?>
<?php
if (isset($_POST['q']) && $_POST['action'] == "search"){
	$recipes = "";
	// Make sure post data is not empty
	$query = htmlentities($_POST['q']);
	if (strlen($query) < 3) {
		header("Location: search.php");
		exit();
	}
	$sql = "SELECT * FROM recipeInfo WHERE (name LIKE ('$query%') OR name LIKE ('%$query%') OR name LIKE ('%$query'))";
    $query = mysqli_query($db_conx, $sql);
    $statusnumrows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $id = $row["id"];
        $name = $row["name"];
        $recipes .= '<li onclick=getRecipe('.$id.')>'.$name.'</li>';
    } 
	if ($recipes == "") {
		$recipes = "no recipes found!";
	}
	echo $recipes;
	exit();
}
include_once("getRecipe.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="alternate" media="only screen and (orientation:portrait)" href="mobile/search.php" >
        <title>Search - Gelly</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="styles.css" type="text/css">
		<script src="ajax.js"></script>
		<script src="getRecipe.js"></script>
		<script>
            function search() { 
				//get query
				var query = document.getElementById('query').value;
				if (query.length < 3) {
					return false;
				}
                //remove the child elements
                var myNode = document.getElementById("recipesList");
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                
                //show loading
                document.getElementById("load").className = "show";
                
                var action = "search";
                var ajax = ajaxObj("POST", "search.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        //hide loading
                        document.getElementById("load").className = "hide";
                        document.getElementById("recipesList").innerHTML = ajax.responseText;
                    }
                }
                ajax.send("action="+action+"&q="+query);
            }
        </script>
		<style>
			#searchBar {
				width: 100%;
			}
			#query {
				width: 80%;
				font-size: 1.5vw;
				border-radius: 10px;
				border: 1px solid black;
				padding: 10px;
			}
			#query:focus {
				border: 1px solid black;
				outline: 0;
			}
			#searchBtn {
				position: absolute;
				width: 8%;
				left: 24vw;
				margin-top: 0.3vw;
			}
			#search {
				margin-bottom: 1vw;
			}
			@media screen and (orientation:portrait) {
                #searchBtn {
                    margin-top: 1.75vw;
                }
            }
		</style>
    </head>
    <?php include_once("header.php");?>
    <body>
        <div id="main">
            <div id="recipes">
                <div id="inner">
					<div id="search">
						<form name="searchBar" id="searchBar" onsubmit="return false;">
							<input type="image" id="searchBtn" onclick="search()" src="searchBtn.png" alt="Search">
							<input type="text" id="query"  minlength="3" placeholder="Search... Min. Characters 3" value="<?php echo $q?>">	
    					</form> 
					</div>
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