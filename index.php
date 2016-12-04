<!DOCTYPE html>
<html>
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#5be7a9">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#5be7a9">
        <!-- iOS Safari -->
        <meta charset="UTF-8">

        <!-- favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-touch-icon-57x57.png?v=v2">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-touch-icon-60x60.png?v=v2">
        <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-touch-icon-72x72.png?v=v2">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-touch-icon-76x76.png?v=v2">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-touch-icon-114x114.png?v=v2">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-touch-icon-120x120.png?v=v2">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-touch-icon-144x144.png?v=v2">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-touch-icon-152x152.png?v=v2">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon-180x180.png?v=v2">
        <link rel="icon" type="image/png" href="/favicon/favicon-32x32.png?v=v2" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon/android-chrome-192x192.png?v=v2" sizes="192x192">
        <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png?v=v2" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon/favicon-16x16.png?v=v2" sizes="16x16">
        <link rel="manifest" href="/favicon/manifest.json?v=v2">
        <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg?v=v2" color="#5bbad5">
        <link rel="shortcut icon" href="/favicon/favicon.ico?v=v2">
        <meta name="msapplication-TileColor" content="#969696">
        <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png?v=v2">
        <meta name="msapplication-config" content="/favicon/browserconfig.xml?v=v2">
        <meta name="theme-color" content="#5be7a9">
        <title>Gelly</title>
        <link href='https://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
        <link href="styles.css" rel="stylesheet" type="text/css">
        <style>
            #main {
                width: 40vw;
                margin: 0 auto;
                padding-top: 2vw;
                font-family: 'Lobster Two', cursive;
            }
            #logoBox {
                margin: 0 auto;
                text-align: center;
                margin-bottom: 2vw;
            }
            #logo {
                width: 10vw;
            }
            .button-link {
                color: white;
                text-decoration: none;
            }
            .button-box {
                background-color: #5be7a9;
                text-align: center;
                padding-top: 0.5vw;
                padding-bottom: 0.5vw;
                font-size: 2vw;
                margin-bottom: 1vw;
                border-radius: 10px;
            }
            .button-box span {
                color: white;
                text-decoration: none;
            }
            @media screen and (orientation:portrait) {
                #main {
                    width: 80vw;
                }
                #logo {
                    width: 30vw;
                }
                .button-box {
                    font-size: 7vw;
                }
            }
        </style>
        <!-- Google Analytics -->
        <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', 'UA-69335089-1', 'auto');
        ga('send', 'pageview');
        </script>
        <script async src='//www.google-analytics.com/analytics.js'></script>
        <!-- End Google Analytics -->
	</head>
	<body>
        <div id="main">
            <div id="logoBox">
                <img id="logo" src="GellyLogo.png"/>
            </div>
			<a class="button-link" href="search.php">
                <div class="button-box hvr-grow hvr-grow">
                    <span>Search!</span>
                </div>
            </a>
            <a class="button-link" href="recipe.php">
                <div class="button-box hvr-grow hvr-grow">
                    <span>I'm feeling hungry!</span>
                </div>
            </a>
            <a class="button-link" href="ihave.php">
                <div class="button-box hvr-grow">
                    <span>I only have these ingredients...</span>
                </div>
            </a>
            <a class="button-link" href="categories.php">
                <div class="button-box hvr-grow">
                    <span>Show me everything you have!</span>
                </div>
            </a>
            <!--<a class="button-link" href="myrecipes.php">
                <div class="button-box hvr-grow">
                    <span>My Recipes</span>
                </div>
            </a>-->
            <a class="button-link" href="#">
                <div class="button-box hvr-grow">
                    <span>Help & About</span>
                </div>
            </a>
        </div>
	</body>
</html>