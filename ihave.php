<?php
// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
    header("Location: mobile/ihave.php");
}
?>
<?php
include_once("api/db_conx.php");
$sql = "SELECT DISTINCT id FROM ingredients LIMIT 30";
if(isset($_GET["ing"])){ 
	$ing = htmlspecialchars($_GET['ing']);
	$amount = htmlspecialchars($_GET['amount']);
    $ing = preg_split("/,/", $ing); //array of ingredients
	include_once("sqlSelectIngredients.php");
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
        $recipes .= '<li onclick=getRecipe('.$id.')>'.$name.'</li>';
    }
}
?>
<?php
if (isset($_POST['ing']) && $_POST['action'] == "getRecipes"){
	// Clean all of the $_POST vars that will interact with the database
	$ing = htmlentities($_POST['ing']);
    $ing = preg_split("/,/", $ing); //array of ingredients
	$amount = htmlentities($_POST['amount']);
    $sql = "SELECT DISTINCT id FROM ingredients";
	include_once("sqlSelectIngredients.php");
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
			$recipes .= '<li onclick=getRecipe('.$id.')>'.$name.'</li>';
		}
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
        <link rel="alternate" media="only screen and (orientation:portrait)" href="mobile/ihave.php" >
		<title>Gelly</title>
		<link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel=stylesheet href="styles.css" type="text/css">
        <script src="ajax.js"></script>
        <script src="getRecipe.js"></script>
        <style>
            #chooser {
                text-align: center;
                margin-bottom: 25px;
            }
            .input_fields_wrap {
                text-align: initial;
            }
            .ui-autocomplete {
                position: fixed;
                margin-left: 100px;
            }
            .ui-menu-item {
                font-size: 1.2vw;
                background-color: #F0F0F0;
                border-radius: 10px;
                padding: 5px;
                list-style: none;
            }
            .ui-menu-item:hover {
                background-color: #C0C0C0;
                list-style: none;
            }
            .ui-helper-hidden-accessible { 
                display: none; 
            }
            .query {
				width: 70%;
				font-size: 1.5vw;
				border-radius: 10px;
				border: 1px solid black;
				padding: 10px;
                margin-right: 10px;
                margin-bottom: 10px;
			}
			.query:focus {
				border: 1px solid black;
				outline: 0;
			}
            
        </style>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script>
			var max_fields      = 25; //maximum input boxes allowed
			var x = 1; //initlal text box count
			var amount;
			<?php include_once("ingredientList.php");?>
			$(document).ready(function() {
				var wrapper         = $(".input_fields_wrap"); //Fields wrapper
				var add_button      = $(".add_field_button"); //Add button ID
				
				$(add_button).click(function(e){ //on add input button click
					e.preventDefault();
					if(x < max_fields){ //max input box allowed
						x++; //text box increment
						$(wrapper).append('<div><input type="text" class="query" id="input '+ x +'"name="mytext[]" onkeyup="return forceLower(this);"/><a href="#" class="remove_field">Remove</a></div>'); 
						$(wrapper).find('input[type=text]:last').autocomplete({
							source: availableAttributes
						});	
						//add input box
					}
				});
				$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
					e.preventDefault(); 
					$(this).parent('div').remove(); 
					if ($('input:last').get(0) === this) {
						x--;
					}
				})
				$("input[name^='mytext']").autocomplete({
					source: availableAttributes
				});	
			});
			
			function getAll() {
				var amount = 0;
				var val = "";
				for(i=1;i<=x;i++) {
					if (document.getElementById('input ' + i +'')) {
						if (jQuery.inArray( document.getElementById('input ' + i +'').value, availableAttributes ) > -1) {
							if (val.indexOf(document.getElementById('input ' + i +'').value) === -1) {
								if (i==x) {
									amount++;
									val += document.getElementById('input ' + i +'').value;									
								} else {
									amount++;
									val += document.getElementById('input ' + i +'').value;
									if (amount >= 1) {
										val += ",";
									}
								}
							}
						}
					}
				}
				getListOfRecipes(val, amount);
			}
			function getListOfRecipes(val, amount) {
				action = "getRecipes";
                //remove the child elements
                var myNode = document.getElementById("recipesList");
                while (myNode.firstChild) {
                    myNode.removeChild(myNode.firstChild);
                }
                
                //show loading
                document.getElementById("load").className = "show";

                var ajax = ajaxObj("POST", "ihave.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        //hide loading
                        document.getElementById("load").className = "hide";
                        document.getElementById("recipesList").innerHTML = ajax.responseText;
                    }
                }
                ajax.send("ing="+val+"&amount="+amount+"&action="+action);
            }
            function forceLower(strInput) {
                strInput.value=strInput.value.toLowerCase();
            }
		</script>
	</head>
    <?php include_once("header.php");?>
    <body>
        <div id="main">
            <div id="recipes">
                <div id="inner">
					<div id="chooser">
						<div class="input_fields_wrap">
							<div>
								<input type="text" class="query" id="input 1"name="mytext[]" placeholder="Start typing ingredients here..."onkeyup="return forceLower(this);">
							</div>
						</div>
						<button class="add_field_button">Add another ingredient</button>
						<button class="getAllinputs" onclick="getAll()">Search</button>
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