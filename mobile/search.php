<?php
include_once("../api/db_conx.php");
$recipes = "";
$showRecipes = "hide";
$q= "";
if(isset($_GET["q"])){
    $query = htmlspecialchars($_GET['q']);
    if (strlen($query) < 3) {
		header("Location: search.php");
		exit();
	}
    $q = $query;
	$sql = "SELECT * FROM recipeInfo WHERE (name LIKE ('$query%') OR name LIKE ('%$query%') OR name LIKE ('%$query'))";
	$recipes = "";
	$query = mysqli_query($db_conx, $sql);
	$statusnumrows = mysqli_num_rows($query);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
		$id = $row["id"];
		$name = $row["name"];
		$recipes .= '<a href="../recipe.php?name='.$name.'&id='.$id.'"><li>'.$name.'</li></a>';
	}
	
	//to show recipes using these classes
	$showRecipes = "show";
	
	if ($recipes == "") {
		$recipes = "no recipes found!";
	}
}
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
        $recipes .= '<a href="../recipe.php?name='.$name.'&id='.$id.'"><li>'.$name.'</li></a>';
    } 
	if ($recipes == "") {
		$recipes = "no recipes found!";
	}
	echo $recipes;
	exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="canonical" href="../search.php" >
		<title>Gelly Search</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
		<link rel=stylesheet type="text/css" href="../styles.css"/>
		<script src="../ajax.js"></script>
		<style>
			#recipes {
				width: 100%;
				overflow-y: inherit;
			}
			#titleLoading {
				font-size: 7vw;
			}
			#inner {
				width: 80%;
			}
            #search {
              margin-bottom: 20vw;
            }
            #searchBar {
              width: 80vw;
              position: fixed;
              float: right;
              top: 15vw;
              left: 10vw;
            }
            #searchBar:before {
              position: absolute;
              top: 0;
              right: 0;
              width: 10vw;
              height: 10vw;
              line-height: 10vw;
              font-family: 'FontAwesome';
              content: '\f002';
              background: #5be7a9;
              text-align: center;
              color: #fff;
              border-radius: 10px;
              -webkit-font-smoothing: subpixel-antialiased;
              font-smooth: always;
              font-size: 5vw;
            }

            #query {
              -moz-box-sizing: border-box;
              -webkit-box-sizing: border-box;
              box-sizing: border-box;
              width: 100%;
              border: 5px solid #5be7a9;
              padding: 5px;
              height: 10vw;
              border-radius: 10px;
              outline: none;
              font-size: 5vw;
            }

            #searchBtn {
              position: absolute;
              top: 0;
              right: 0;
              width: 10vw;
              height: 10vw;
              opacity: 0;
              cursor: pointer;
            }
            @media screen and (orientation:portrait) {
                #search {
                    margin-bottom: 12.5vw;
                }
            }
		</style>
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
                document.getElementById("titleLoading").className = "show";
				document.getElementById("recipes").className = "hide";
				
				//change url
				var extraURL = "?q="+query;
				window.history.pushState("Gelly Search", "Gelly Search", extraURL);
                
                var action = "search";
                var ajax = ajaxObj("POST", "search.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        //hide loading
                        document.getElementById("titleLoading").className = "hide";
                        document.getElementById("recipes").className = "show";
                        document.getElementById("recipesList").innerHTML = ajax.responseText;
                    }
                }
                ajax.send("action="+action+"&q="+query);
            }
        </script>
	</head>
    <?php include_once("header.php");?>
	<body>
		<div id="main">
			<div id="search">
				<form name="searchBar" id="searchBar" onsubmit="return false;">
					<input type="text" id="query"  minlength="3" placeholder="Search... Min. Characters 3" value="<?php echo $q?>">	
					<input type="submit" id="searchBtn" onclick="search()">
				</form> 
			</div>
			<div id="titleLoading" class="hide"><span>Loading</span></div>
			<div id="recipes" class="<?php echo $showRecipes;?>">
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