<?php
        include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    echo $query = "select * from webhook where codigo = '{$_GET['codigo']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

    $dados = json_decode($d->mailgun);

    echo $dados->$html;

