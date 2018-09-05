<html lang="en">
    <head>
        <meta name="description" content="Online Book Store" />
        <meta name="keywords" content="book, store, shop, books, novels, book store" />
        <meta charset="utf-8" />
        <title>Online Book Store</title>
        <link href="index.css" rel="stylesheet" type="text/css">
        <link href="favicon.ico" rel="shortcut icon" >
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/validateLogin.js"></script>
    </head>
    
    <body>
        <?php
		$auth=""; 
		require ('php/nav.php'); 
	    ?>
        <div id="wrapper">
         <div id="loginForm" >
        <form id="login" method="Post" action="php/login.php">
            <input type="text" name="email" placeholder="Email Address" id="email" autofocus class="medium-long"><br/>
            <input type="password" name="password" placeholder="Password" id="password" class="medium-long"> <br/>
            
            <input type="submit" name="submit" value="Log In" id="Login" class="submit btn">  
        </form>
        </div>
        </div>
        <?php include("php/footer.php");?>
    </body>
</html>