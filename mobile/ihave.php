<!DOCTYPE html>
<html>
	<head>
        <link rel="canonical" href="../ihave.php" >
		<title>Gelly</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <link rel=stylesheet href="../styles.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
        <style>
            #chooser {
				margin: 0 auto;
                margin-bottom: 25px;
				width: 80vw;
            }
            .ui-autocomplete {
                position: fixed;
                margin-left: 100px;
            }
            .ui-menu-item {
                font-size: 4vw;
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
			.query:focus {
				border: 1px solid black;
				outline: 0;
			}
            .query {
				margin-top: 1vw;
				text-align: initial;
				width: 93%;
				font-size: 5vw;
				border-radius: 10px;
				border: 1px solid black;
				padding: 10px;
				margin-bottom: 5px;
			}
			.query:focus {
				border: 1px solid black;
				outline: 0;
			}
			.add_field_button,.getAllinputs {
				font-size: 5vw;
			}
			.remove_field {
				font-size: 3.5vw;
			}
        </style>
		<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script>
			var max_fields      = 10; //maximum input boxes allowed
			var x = 1; //initlal text box count
			var amount;
			<?php include_once("../ingredientList.php");?>
			$(document).ready(function() {
				var wrapper         = $(".input_fields_wrap"); //Fields wrapper
				var add_button      = $(".add_field_button"); //Add button ID
				
				$(add_button).click(function(e){ //on add input button click
					e.preventDefault();
					if(x < max_fields){ //max input box allowed
						x++; //text box increment
						$(wrapper).append('<div><input type="text" class="query" id="input '+ x +'"name="mytext[]" onkeyup="return forceLower(this);"/><a href="#" class="remove_field">Remove this ingredient</a></div>'); 
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
				window.location = "list.php?ing="+val+"&amount="+amount;
			}
            function forceLower(strInput) {
                strInput.value=strInput.value.toLowerCase();
            }
		</script>
	</head>
    <?php include_once("header.php");?>
    <body>
        <div id="main">
			<div id="chooser">
				<div class="input_fields_wrap">
					<div>
						<input type="text" class="query" id="input 1"name="mytext[]" placeholder="Start typing ingredients here..." onkeyup="return forceLower(this);"/>
					</div>
				</div>
				<button class="add_field_button">Add another ingredient</button>
				<button class="getAllinputs" onclick="getAll()">Search</button>
			</div>
        </div>
    </body>
</html>