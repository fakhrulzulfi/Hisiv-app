<?php 

    session_abort();
    session_unset();

    header('Location : '. BASE_URL .'/login');
    exit;