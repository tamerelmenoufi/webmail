<?php

    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    $query = "select * from webhook where codigo = '{$_GET['codigo']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);

    $d1 = file_get_contents("http://mailgun.mohatron.com/emails/{$d->codigo}/dados.json");

    $dados = json_decode($d1);

    $cid = "content-id-map";
    $img_corpo = json_decode($dados->$cid);
    print_r($img_corpo);


    $html = "body-html";
    echo $dados->$html;

?>