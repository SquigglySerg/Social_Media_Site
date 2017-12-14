<style>
div.sitename {
	background-color: #4C4C4C;
	color: white;
    text-align: center;
    padding: 14px 16px;
}

ul.topnav li {
    border-right: 1px solid #bbb;
}

ul.topnav li:last-child {
    border-right: none;
}

ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #403F3F;
}

ul.topnav li {float: left;}

ul.topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

ul.topnav li a:hover:not(.active) {background-color: #111;}

ul.topnav li a.active {background-color: #4CAF50;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px){
    ul.topnav li.right, 
    ul.topnav li {float: none;}
}
</style>
<div class="sitename"><h1>Modern Peeps Non-Dating Site</h1></div>
<ul class="topnav">
  <li><a href="./index.php" <?php if($active == "index"){echo "class=\"active\"";} ?>>Home</a></li>
  <li><a href="./profile.php" <?php if($active == "profile"){echo "class=\"active\"";} ?>>Profile</a></li>
  <li class="right"><a href="./register.php" <?php if($active == "register"){echo "class=\"active\"";} ?>>Sign Up</a></li>
  <li class="right"><a href="./login.php" <?php if($active == "login"){echo "class=\"active\"";} ?>>Login</a></li>
</ul>
