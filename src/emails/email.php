<?php
        include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    $query = "select * from webhook where codigo = '{$_GET['codigo']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

    $dados = json_decode(file_get_contents("http://mailgun.mohatron.com/emails/{$d->codigo}/dados.json"));

    $html = "body-html";
    echo $dados->$html;

