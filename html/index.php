<?php
session_start();
require_once('/var/www/lib/Page.php');
require_once('OSMOAuthClient.php');

class OSMUKPage extends Page {
    public function writeBody() {
?>


<body onload='init()'>
<div id="container">
<div id="logodiv">
<img src="images/osmuk.png" alt="OSM UK" width='100px' />
</div>
<div id="whatis"> 
<h1>Development site for the OSM-UK map</h1>
</div>
<?php
try {
    $oauth = new OSMOAuthClient();
    $action = isset($_GET["action"]) ? $_GET["action"] : ""; 
    if($action=="logout") {
        session_destroy();
    } elseif(isset($_SESSION["access_token"])&&
            isset($_SESSION["access_secret"])){
        $oauth->setToken($_SESSION["access_token"], 
                                    $_SESSION["access_secret"]);
        $user = $oauth->getUser();
    } elseif($action=="login") {
        $requestToken = $oauth->login();
    // if running as the oauth callback...
    }elseif(isset($_GET["oauth_token"]) && isset($_SESSION["request_secret"])) {
        $at = $oauth->getAccessToken($_GET['oauth_token'], 
            $_SESSION['request_secret']);
        unset($_SESSION["request_secret"]);
        $_SESSION["access_token"] = $at["oauth_token"];
        $_SESSION["access_secret"] = $at["oauth_token_secret"];
        $oauth->setToken($_SESSION["access_token"], 
                                    $_SESSION["access_secret"]);
        $user = $oauth->getUser();
    }
} catch(OAuthException $e) {
    $error = $e->lastResponse;
}

?> 
<div id="loginform">
<a href='https://github.com/osmuk/website_real'>
GitHub repo</a> |
<?php
if(isset($user)) {
    echo "Logged in as $user. <a href='?action=logout'>Logout</a>";
} else {
    echo "<a href='?action=login'>Login</a>";
}
?>
</div>
<?php
if(isset($error)) {
    echo "<p><strong>ERROR:</strong> $error<br />";
}
?>

<div id="map"></div>

</div>

</body>
<?php
    }
}

$page = new OSMUKPage();
$scripts = ['js/main.js',
            'jslib/leaflet.js'];
$css = ['css/style.css',
        'jslib/leaflet.css'];
$page->writePage('OSMUK', $scripts, $css);

?>
