<?php
session_start();
unset($_SESSION['user_session']);
if(session_destroy())
{
    header("location: ../1_publico/1_paginas/index.php");
}
?>