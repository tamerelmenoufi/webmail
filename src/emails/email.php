<?php
        include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    $query = "select * from webhook where codigo = '{$_GET['codigo']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

    $d1 = file_get_contents("http://mailgun.mohatron.com/emails/{$d->codigo}/dados.json");

    $dados = json_decode($d1);

    $html = "body-html";
    echo $dados->$html;

    echo "<pre>";
    echo $d1;
    echo "</pre>";


