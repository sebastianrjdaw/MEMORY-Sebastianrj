<?php 
    // MEMORY - LOG OFF
    // SEBASTIAN RJ
    // 13/12/2022

    
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
header("Location: https://www.google.es/");
?>