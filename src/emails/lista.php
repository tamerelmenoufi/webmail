<?php
        include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");
?>
<style>

</style>
<?php

    $query = "select * from webhook order by codigo desc limit ".(($_POST['limit'])?:'0').", 20 ";
    $result = mysqli_query($con, $query);


    while($d = mysqli_fetch_object($result)){

        echo ("../../emails/{$d->codigo}/dados.json");
        
        // print_r($dados);
        // $html = "body-html";
        // echo $dados->from."<br>";
        // echo $dados->To."<br>";
        // echo $dados->domain."<br>";
        // echo $dados->subject."<br>";
        // echo $dados->$html."<hr>";

        // echo "<br><br><br>";

?>
<li class="list-group-item">

    <div class="d-flex justify-content-between align-items-center ItemEmail">
        <div class="p-2">
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <!-- <label class="form-check-label" for="exampleCheck1">Marcar Todos</label> -->
            </div>
        </div>
        <div class="p-2 d-flex flex-column align-items-start flex-grow-1" abrir="<?=$d->codigo?>">
            <h5><?=$dados->from?></h5>
            <span><?=$dados->subject?></span>
            <span><?=$dados->Date?></span>
        </div>
        <div class="p-2">
            <i acao class="fa-solid fa-computer d-none d-md-block"></i>
            <i acao class="fa-solid fa-mobile-screen-button d-block d-sm-none"></i>
        </div>
    </div>

</li>
<?php
}
?>

<script>

    $(function(){
        Carregando('none')

        $(document).off('click').on('click','div[abrir]', function(){
            codigo = $(this).attr("abrir");
            $(".conteudo").attr("src", `src/emails/email.php?codigo=${codigo}`);
        }).on('click',"i[acao]", function(){
            $.alert('teste')
        });;


       // $(document).off('click')

    });

</script>


