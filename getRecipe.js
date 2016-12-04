function getRecipe(id) {
    //show loading
    document.getElementById("titleLoading").className = "show";
    //hide everything
    document.getElementById("recipecontainer").className = "hide";
    var action = "find_recipe";
    var ajax = ajaxObj("POST", "search.php");
    ajax.onreadystatechange = function() {
        if(ajaxReturn(ajax) == true) {
            //hide loading
            document.getElementById("titleLoading").className = "hide";
            //show everything
            document.getElementById("recipecontainer").className = "show";
            document.getElementById("ingredients").className = "show";
            document.getElementById("method").className = "show";
            document.getElementById("share").className = "show";
            var rp = ajax.responseText; //the response text
            var rp = rp.split("|");//split the response into an array

            document.getElementById("titlespan").innerHTML=rp[0];
            document.getElementById("ingredientList").innerHTML = rp[1];
            document.getElementById("methodList").innerHTML = rp[2];
            document.getElementById("img").src=rp[3];
            document.getElementById("descSpan").innerHTML=rp[5];
            document.getElementById("authorSpan").innerHTML=rp[6];
            window.history.pushState(rp[0], rp[0], 'recipe.php?name='+rp[0]+'&id='+rp[4]);

            var pageURL = encodeURIComponent(window.location.protocol + "//" + window.location.host + "/" + window.location.pathname);
            var pageID = "?name="+rp[0]+"%26id="+rp[4];
            var facebookLink = "http://www.facebook.com/sharer/sharer.php?u="+pageURL+pageID+"&t="+rp[0];
            var twitterLink = "https://twitter.com/intent/tweet?text=Check out this tasty recipe - "+pageURL+pageID+" %23Gelly %23food";
            var redditLink = "https://www.reddit.com/submit?url="+pageURL+pageID+"&title="+rp[0];
            document.getElementById("shareFacebook").href = facebookLink;
            document.getElementById("shareTwitter").href = twitterLink;
            document.getElementById("shareReddit").href = redditLink;
        }
    }
    ajax.send("action="+action+"&id="+id);
}