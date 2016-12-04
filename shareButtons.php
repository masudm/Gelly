<script>
var pageURL = encodeURIComponent(window.location.protocol + "//" + window.location.host + "/" + window.location.pathname);
var pageID = "?name=<?php echo $name?>%26id=<?php echo $id?>";
var facebookLink = "http://www.facebook.com/sharer/sharer.php?u="+pageURL+pageID+"&t=<?php echo $name?>";
var twitterLink = "https://twitter.com/intent/tweet?text=Check out this tasty recipe - "+pageURL+pageID+" %23Gelly %23food";
var redditLink = "https://www.reddit.com/submit?url="+pageURL+pageID+"&title=<?php echo $name?>";
document.getElementById("shareFacebook").href = facebookLink;
document.getElementById("shareTwitter").href = twitterLink;
document.getElementById("shareReddit").href = redditLink;
</script>