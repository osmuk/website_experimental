<!DOCTYPE html>
<html>
<head>
<title>OSMUK</title>
<script type='text/javascript' src='jslib/leaflet.js'></script>
<script type='text/javascript' src='js/main.js'></script>
<link rel='stylesheet' href='jslib/leaflet.css' type='text/css'/>
<link rel='stylesheet' href='css/style.css' type='text/css' />
</head>

<body onload='init()'>
<p>
<img src="images/osmuk.png" alt="OSM UK" width='100px' />
</p>
<?php

// TODO: oauth authentication with OSM 
if(isset($_POST["username"])) {
    echo "Login functionality not working at present, come back soon!".
    " <a href=''>Back to main page</a>";    
    // process login details ..
} else { 
?>

<div id="container">

<div id="loginform">
<form method="post" action="">
<label for="username">OSM Username:</label>
<input name="username" id="username" />
<label for="password">OSM Password:</label>
<input name="password" id="password" type="password" />
<input type="submit" value="Go!" />
</form>
</div>

<div id="map"></div>

</div>

</body>
</html>
<?php
}
?>
