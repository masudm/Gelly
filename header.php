<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#5be7a9">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#5be7a9">
    <!-- iOS Safari -->
    <meta charset="UTF-8">
    
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-touch-icon-57x57.png?v=v2">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-touch-icon-60x60.png?v=v2">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-touch-icon-72x72.png?v=v2">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-touch-icon-76x76.png?v=v2">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-touch-icon-114x114.png?v=v2">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-touch-icon-120x120.png?v=v2">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-touch-icon-144x144.png?v=v2">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-touch-icon-152x152.png?v=v2">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon-180x180.png?v=v2">
    <link rel="icon" type="image/png" href="faviconfavicon-32x32.png?v=v2" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon/android-chrome-192x192.png?v=v2" sizes="192x192">
    <link rel="icon" type="image/png" href="faviconfavicon-96x96.png?v=v2" sizes="96x96">
    <link rel="icon" type="image/png" href="faviconfavicon-16x16.png?v=v2" sizes="16x16">
    <link rel="manifest" href="favicon/manifest.json?v=v2">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg?v=v2" color="#5bbad5">
    <link rel="shortcut icon" href="faviconfavicon.ico?v=v2">
    <meta name="msapplication-TileColor" content="#969696">
    <meta name="msapplication-TileImage" content="favicon/mstile-144x144.png?v=v2">
    <meta name="msapplication-config" content="favicon/browserconfig.xml?v=v2">
    <meta name="theme-color" content="#5be7a9">
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
    <script>
        function navSearch() {
            var query = document.getElementById("navQuery").value;
            if (query.length < 3) {
                return false;
            } else {
                window.location = "search.php?q="+query;
            }
        }
    </script>
	<div id="nav">
		<div id="bar">
			<div id="logoBox">
				<a href="index.php">
					<img id="logo" src="GellyLogo.png"/>
				</a>
			</div>
             <div id="navSearch">
                <form class="search" name="navSearchBar" id="navSearchBar" onsubmit="return false;">
                    <input class="searchTerm" type="text" id="navQuery"  minlength="3" placeholder="Search... Min. Characters 3">
                    <input class="searchButton" type="submit" id="navSearchBtn" onclick="navSearch()">
                </form> 
            </div>
		</div>
	</div>
</body>