<?php
    session_start();
    include("../../sis/MysqlConnect.php");
    include("fn.php");
    // $con = AppConnect('api_mailgun');
    $md5 = md5(date("YmdHis"));

    $urlPainel = 'http://emails.mohatron.com/';