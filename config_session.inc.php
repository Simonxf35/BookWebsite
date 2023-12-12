<?php>
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_only_cookies', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => localhost,
    'path' => '/',
    'secure' => true,
    'httponly' => true,
]);
// starts the session and checks for expired sessions and regenerates in if true
function session_regenerate_id (){
    session_regenerate_id();
        $_SESSION["last_regeneration"] = time(); 
}
session_start();

if (!isset($_SESSION["last_regeneration"])){
    session_regenerate_id();
} else{
    $interval = 60 * 30;
    if (time() - $-SESSION["last_regeneration"] >= $interval){
        session_regenerate_id();
    }
}


    
</?php>