<?php
include_once("api/db_conx.php");
$posted = 0;

if(isset($_POST["id"])){
    $id = $_POST['id']; //make sure this does not already exist
    $category = $_POST['category']; //what type of food or 'category' is it in?
    $name = $_POST['name']; //the name of the food/recipe
    $ing = preg_split("/,/", $_POST['ingredients']); //array of ingredients
    $longing = $_POST['longing']; //ingredients with measurements, etc...
    $method = $_POST['method']; //the method with each step seperated by a |
    $imgURL = $_POST['img']; //the path to the image
    $desc = $_POST['desc']; //the description of the recipe
    $author = $_POST['author']; //author

    $allIngredients = "";
    for($i=0;$i<count($ing);$i++) {
        if ($i != 0) {
            $allIngredients .= "|";
        }
        $allIngredients .= $ing[$i];
    }

    $sql = "INSERT INTO recipes(id, category, name) 
                         VALUES('$id','$category','$name')";
    $query = mysqli_query($db_conx, $sql);
    $sql = "INSERT INTO recipeInfo(id, name, ingredients, method, img, description, author) 
                         VALUES($id,'$name','$longing','$method','$imgURL','$desc','$author')";
    $query = mysqli_query($db_conx, $sql);

    for($i=0;$i<count($ing);$i++){
        //ing2
        $sql = "INSERT INTO ingredients(id, ingredient) 
                             VALUES($id,'$ing[$i]')";
        $query = mysqli_query($db_conx, $sql);
    }

    $posted++;
    echo "</br>";
    echo "success";
    exit();
}

?>

<!DOCTYPE html>
<html>
    <body>
        <script src="ajax.js"></script>
        <script>
            function submit(){
            document.getElementById("submit").style.display = "none";
            var id = document.getElementById("id").value;
            var category = document.getElementById("category").value;
            var name = document.getElementById("name").value;
            var longIngredients = document.getElementById("longIngredients").value;
            var ingredients = document.getElementById("ingredients").value;
            var method = document.getElementById("method").value;
            var img = document.getElementById("img").value;
            var desc = document.getElementById("desc").value;
            var author = document.getElementById("author").value;
                var ajax = ajaxObj("POST", "insertRECIPESintoTABLE.php");
                ajax.onreadystatechange = function() {
                    if(ajaxReturn(ajax) == true) {
                        if(ajax.responseText != "success"){
                            document.getElementById("submit").style.display = "block";
                            alert(ajax.responseText);
                        } else {
                            alert("done!");
                        }
                    }
                }
                ajax.send("id="+id+"&category="+category+"&name="+name+"&longing="+longIngredients+
                          "&ingredients="+ingredients+"&method="+method+
                          "&img="+img+"&desc="+desc+"&author="+author);
            }
        </script>
        <form name="newRecipe" id="recipeForm">
            <input type="text" id="id" placeholder="id">    
            <input type="text" id="category" placeholder="category">    
            <input type="text" id="name" placeholder="name">    
            <input type="text" id="longIngredients" placeholder="longIngredients">    
            <input type="text" id="ingredients" placeholder="ingredients">    
            <input type="text" id="method" placeholder="method">    
            <input type="text" id="img" placeholder="imgPath">    
            <input type="text" id="desc" placeholder="description">    
            <input type="text" id="author" placeholder="author">   
        </form> 
        <a href=""><span onclick="submit()" id="submit">Go</span></a>
    </body>
</html>