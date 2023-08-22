<?php
function flash()
{
    $_SESSION['flash'] = $_POST;
}

function clearFlash()
{
    unset($_SESSION['flash']);
}
