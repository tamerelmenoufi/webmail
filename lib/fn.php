<?php

    function dataBr($dt){
        list($d, $h) = explode(" ",$dt);
        list($y,$m,$d) = explode("-",$d);
        $data = false;
        if($y && $m && $d){
            $data = "{$d}/{$m}/$y"; //.(($h)?" {$h}":false);
        }
        return $data;
    }

    function dataMysql($dt){
        list($d, $h) = explode(" ",$dt);
        list($d,$m,$y) = explode("/",$d);
        $data = false;
        if($y && $m && $d){
            $data = "{$y}-{$m}-$d"; //.(($h)?" {$h}":false);
        }
        return $data;
    }

    function sisLogRegistro($q){
        global $con;
        $q = strtolower($q);
        list($p1, $p2) = explode("set", $q);
        list($p3, $p4) = explode("where", $q);
        $query = str_replace("update", "select codigo from", $p1)." where ".$p4;
        $result = mysqli_query($con, $query);
        $r = [];
        while($d = mysqli_fetch_object($result)){
            $r[] = (int)($d->codigo);
        }
        return json_encode($r);
    }

    function sisLog($d){

        $remove = ["\\n", "\\t", "  ", "	"];
        $d = str_replace($remove, " ", $d);

        global $con;
        global $_POST;
        global $_SESSION;
        global $_SERVER;
        $r = [];
        $tabela = false;

        $result = mysqli_query($con, $d);
    
        $query = addslashes($d);
        $file = $_SERVER["PHP_SELF"];
        $sessao = addslashes(json_encode($_SESSION));
        $dados = addslashes(json_encode($_POST));
        $p = explode(" ",trim($query));
        $operacao = strtoupper(trim($p[0]));
        if(strtolower(trim($p[0])) == 'insert'){
            $tabela =  strtoupper(trim($p[2]));
            $r[] = mysqli_insert_id($con);
            $registro = json_encode($r);
        }
        if(strtolower(trim($p[0])) == 'update'){
            $tabela =  strtoupper(trim($p[1]));
            $registro = sisLogRegistro($d);
        }

        if($tabela){
            mysqli_query($con, "
                INSERT INTO sisLog set 
                                        file = '{$file}',
                                        tabela = '{$tabela}',
                                        operacao = '{$operacao}',
                                        registro = '{$registro}',
                                        sessao = '{$sessao}',
                                        dados = '{$dados}',
                                        query = '{$query}',
                                        data = NOW()
            ");
        }

        return $result;
    
    }

