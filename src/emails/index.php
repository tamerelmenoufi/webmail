<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");


    $query = "select * from webhook where mailgun->>'$.To' != '' and mailgun->>'$.To' is not null order by codigo desc limit 10";
    $result = mysqli_query($con, $query);

    while($d = mysqli_fetch_object($result)){

        $dados = json_decode($d->mailgun);
        print_r($dados);
        // echo $dados['from']."<br>";
        // echo $dados['to']."<br>";
        // echo $dados['domain']."<br>";
        // echo $dados["subject"]."<br>";
        // echo $dados['body-html']."<hr>";

        echo "<br><br><br>";
    }

?>

<script>
    $(function(){

        Carregando('none');

    })
</script>