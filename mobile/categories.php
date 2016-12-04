<!DOCTYPE html>
<html>
    <head>
        <link rel="canonical" href="../categories.php" >
        <title>Gelly - Categories</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
        <link rel=stylesheet href="../styles.css" type="text/css">
		<style>
			#category {
				position: initial;
				width: 80vw;
				overflow-y: initial;
				margin: 0 auto;
			}
		</style>
		<script>
			function getRecipesList(category) {
				window.location = "list.php?category="+category;
			} 
		</script>
    </head>
    <?php include_once("header.php");?>
    <body>
        <div id="main">
            <div id="category">
                <div id="inner">
                    <span>Pick a Category:</span>
                    <ul>
						<?php include_once("../catergoriesList.php");?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>