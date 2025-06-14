<?php
// ------------ CHECK IF LOGGED IN ----------------------
function isLoggedIn()
{
    return !!isset($_SESSION['loggedIn']);
}
