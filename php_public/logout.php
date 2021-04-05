<?php
session_start();
if ($_SESSION["admin"] = true){
    session_destroy();
}
Header("Location:../Homepage/homepage.html");
