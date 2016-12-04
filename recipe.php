<?php
	include_once("api/db_conx.php");
	if(isset($_GET["id"])){
		$id = htmlspecialchars($_GET['id']);
		$sql = "SELECT * FROM recipeInfo WHERE id='$id' LIMIT 1";
        if(isset($_GET["name"])) {
            $name = htmlentities($_GET["name"]);
            $sql = "SELECT * FROM recipeInfo WHERE id='$id' AND name='$name' LIMIT 1";
        }
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
        if($statusnumrows == 0) {
            header("Location: error.php?error=No recipe found.");
        } else {
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
        }
	} else {
		$rows = mysqli_query($db_conx, "SELECT id FROM recipeInfo");
        if (false === $rows) {
    echo mysqli_error($db_conx);
            return false;
}
		$rows = mysqli_num_rows($rows);
		$id = rand(1, $rows);
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
	}
    $metaDesc = $name." - ".$desc;
    $keywords = $name.",";
    $keywords .= str_replace(" ",",",$desc);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta property="og:title" content="<?php echo $name?>">
        <meta property="og:image" content="<?php echo $img?>">
        <meta property="og:description" content="<?php echo $desc?>">
        <meta name="keywords" content="<?php echo $keywords?>">
        <meta name="description" content="<?php echo $metaDesc?>">
        <title><?php echo $name?> - Gelly</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="styles.css" type="text/css">
        <style>
            #main {
                margin: 0 auto;
                width: 60vw;
				padding-top: 4vw;
            }
            .list {
                margin: 0;
                padding: 0 2.5vw;
            }
            #ingredients {
                width: 40%;
                float: left;
            }
            #method {
                margin-top: -0.5vw;
                width: 60%;
                float: right; 
            }
			#share {
				left: 17.5vw;
			}
            @media screen and (orientation:portrait) {
                #main {
                    width: 80vw;
                    padding-top: 15vw;
                }
                #share {
                    left: -0.5vw;
                    width: 80vw;
                }
                #ingredients {
                    width: 100%;
                    float: none;
                }
                #method {
                    width: 100%;
                    float: none;
                    margin-top: 10px;
                }
            }
        </style>
    </head>
    <?php include_once("header.php");?>
    <body>
        <div id="main">
            <div id="title">
                <h1 id="title"><?php echo $name?></h1>
            </div>  
            <div id="image">
                <img src="<?php echo $img?>"/>
            </div>
			<div id="share">
				<span>Share this recipe:</span>
				<a id="shareFacebook" href="http://www.facebook.com/sharer/sharer.php?u=&t=" target="_blank"><img src="Facebook.png"></a>
				<a id="shareTwitter" href="https://twitter.com/intent/tweet?text=" target="_blank"><img src="Twitter.png"></a>
				<a id="shareReddit" href="https://www.reddit.com/submit?url=&title=" target="_blank"><img src="reddit.png"></a>
			</div>
            <div id="desc">
                <h2 id="desc"><?php echo $desc?></h2>
            </div>
            <div id="author">
                <span id="authorSpan" class="source"><?php echo $author?></span>
            </div>
            <div id="ingredients">
                <span class="subhead"><b>Ingredients:</b></span>
                <ul class="list">
                    <?php echo $ing?>
                </ul>
            </div>
            <div id="method">
                <span class="subhead"><b>Method:</b></span>
                <ol class="list">
                    <?php echo $meth?>
                </ol>
            </div>
        </div>
		<?php include_once("shareButtons.php");?>
        <script>
            window.history.pushState("<?php echo $name?>", "<?php echo $name?>", "recipe.php?name=<?php echo $name?>&id=<?php echo $id?>");
        </script>
    </body>
</html>