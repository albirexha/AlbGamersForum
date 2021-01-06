<?php include "sqlFunctions.php"; session_start(); ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" />
    <link href="default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="inc/jquery-1.12.1.js"></script>
</head>

<body>
<div id="header-wrapper">
        <div id="header" class="container">
            <div id="logo">
                <h1><a href="index.php">ALB GAMERS FORUM</a></h1>
            </div>
            <div id="menu">
                <ul>
                    <li class="current_page_item"><a href="index.php" accesskey="1" title="" >Home</a></li>
                    <?php if(isset($_SESSION["anetariid"])): ?>
                    <li><a href="postimet.php" accesskey="2" title="">Postimet</a></li>
                    <li><a href="myposts.php" accesskey="3" title="">Postimet e mia</a></li>
                    <li><a href="pa-aprovuar.php" accesskey="4" title="">Aprovimet</a></li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['roli']) && $_SESSION['roli']==1): ?>
                    <li><a href="anetaret.php" accesskey="4" title="">Anetaret</a></li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['roli']) && $_SESSION['roli']==2): ?>
                    <li><a href="anetari.php?aid=<?php echo $_SESSION['anetariid'];?>" accesskey="4" title="">Llogaria</a></li>
                    <?php endif; ?>
                    <?php if(isset($_SESSION["roli"])): ?>
                    <li><a style="min-width: 80px; color: yellow;" href="logout.php" id="logout" accesskey="5" title=""><?php echo $_SESSION["username"]; ?></a></li>
                    <script>
                        var logout = document.getElementById('logout');
                        logout.onmouseover = function(){
                            logout.innerHTML = "Logout";
                            logout.style.color = "red";
                        }

                        logout.onmouseout = function(){
                            logout.innerHTML = "<?php echo $_SESSION["username"]; ?>";
                            logout.style.color = "yellow";
                        }
                    </script>
                    <?php else: ?>
                    <li><a href="logout.php" id="logout" accesskey="5" title=""> Login </a></li>
                    <?php endif; ?>
                </ul>
                
            </div>

        </div>
    </div>
    <div id="cover" class="container">
        <a href="newpost.php" class="transparent_btn">NEW DISCUSSION</a>
    </div>
    <div id="container1">
<script>
jQuery(function() {
    $('#menu ul li.current_page_item').removeClass('current_page_item');
    var page = window.location.href.match(/[^/]+$/)[0];
    $('#menu ul li a[href$="' + page + '"]').closest('li').addClass('current_page_item');
});



</script>