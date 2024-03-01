<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/lib/includes.php");

    if($_POST['delete']){
      // $query = "delete from usuarios where codigo = '{$_POST['delete']}'";
      $query = "update usuarios set deletado = '1' where codigo = '{$_POST['delete']}'";
      sisLog($query);
    }

    if($_POST['situacao']){
      $query = "update usuarios set situacao = '{$_POST['opc']}' where codigo = '{$_POST['situacao']}'";
      sisLog($query);
      exit();
    }


    if($_POST['filtro'] == 'filtrar'){
      $_SESSION['usuarioBusca'] = $_POST['campo'];
    }elseif($_POST['filtro']){
      $_SESSION['usuarioBusca'] = false;
    }

    if($_SESSION['usuarioBusca']){
      $cpf = str_replace( '.', '', str_replace('-', '', $_SESSION['usuarioBusca']));
      $where = " and nome like '%{$_SESSION['usuarioBusca']}%' or REPLACE( REPLACE( cpf, '.', '' ), '-', '' ) = '{$cpf}' ";
    }



?>
<style>
  .btn-perfil{
    padding:5px;
    border-radius:8px;
    color:#fff;
    background-color:#a1a1a1;
    cursor: pointer;
  }
  td, th{
    white-space: nowrap;
  }
  .label{
    font-size:10px;
    color:#a1a1a1;
  }
</style>
<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Usuários</h5>
          <div class="card-body">
            <div class="d-none d-md-block">
              <div class="d-flex justify-content-between mb-3">
                  <div class="input-group">
                    <label class="input-group-text" for="inputGroupFile01">Buscar por </label>
                    <input campoBusca type="text" class="form-control" value="<?=$_SESSION['usuarioBusca']?>" aria-label="Digite a informação para a busca">
                    <button filtro="filtrar" class="btn btn-outline-secondary" type="button">Buscar</button>
                    <button filtro="limpar" class="btn btn-outline-danger" type="button">limpar</button>
                  </div>


                  <button
                      novoCadastro
                      class="btn btn-success btn-sm"
                      data-bs-toggle="offcanvas"
                      href="#offcanvasDireita"
                      role="button"
                      aria-controls="offcanvasDireita"
                      style="margin-left:20px;"
                  >Novo</button>
              </div>
            </div>

            <div class="d-block d-md-none d-lg-none d-xl-none d-xxl-none">
              <div class="d-flex justify-content-between mb-3">

                  <div class="row">
                    <div class="col-12 mb-2">
                      <div class="input-group">
                        <label class="input-group-text" for="inputGroupFile01">Buscar por </label>
                        <input campoBusca type="text" class="form-control" value="<?=$_SESSION['usuarioBusca']?>" aria-label="Digite a informação para a busca">
                      </div>
                    </div>
                    <div class="col-12 mb-2">
                      <button filtro="filtrar" class="btn btn-outline-secondary w-100" type="button">Buscar</button>
                    </div>
                    <div class="col-12 mb-2">
                      <button filtro="limpar" class="btn btn-outline-danger w-100" type="button">limpar</button>
                    </div>
                    <div class="col-12 mb-2">
                      <button
                          novoCadastro
                          class="btn btn-success btn-sm w-100"
                          data-bs-toggle="offcanvas"
                          href="#offcanvasDireita"
                          role="button"
                          aria-controls="offcanvasDireita"
                      >Novo</button>                      
                    </div>
                  </div>
              </div>
            </div>

            <div class="table-responsive d-none d-md-block">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query = "select * from usuarios where deletado != '1' {$where} order by nome asc";
                    $result = sisLog($query);
                    
                    while($d = mysqli_fetch_object($result)){
                  ?>
                  <tr>
                    <td class="w-100"><?=$d->nome?></td>
                    <td><?=$d->cpf?></td>
                    <td>

                    <div class="form-check form-switch">
                      <input class="form-check-input situacao" type="checkbox" <?=(($d->codigo == 1)?'disabled':false)?> <?=(($d->situacao)?'checked':false)?> usuario="<?=$d->codigo?>">
                    </div>

                    </td>
                    <td>
                      <button
                        class="btn btn-primary"
                        edit="<?=$d->codigo?>"
                        data-bs-toggle="offcanvas"
                        href="#offcanvasDireita"
                        role="button"
                        aria-controls="offcanvasDireita"
                      >
                        Editar
                      </button>
                      <?php
                      if($d->codigo != 1){
                      ?>
                      <button class="btn btn-danger" delete="<?=$d->codigo?>">
                        Excluir
                      </button>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>


            <div class="d-block d-md-none d-lg-none d-xl-none d-xxl-none">
            <?php
                  $query = "select * from usuarios where deletado != '1' {$where} order by nome asc";
                  $result = sisLog($query);
                  
                  while($d = mysqli_fetch_object($result)){
                ?>
                <div class="card mb-3 p-3">
                    <div class="row">
                      <div class="col-12 d-flex justify-content-end">
                        <div class="form-check form-switch">
                          <input class="form-check-input situacao" type="checkbox" <?=(($d->codigo == 1)?'disabled':false)?> <?=(($d->situacao)?'checked':false)?> situacao="<?=$d->codigo?>">
                          Situação
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <label class="label">Nome</label>
                        <div><?=$d->nome?></div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                      <label class="label">CPF</label>
                       <div><?=$d->cpf?></div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6 p-2">
                        <button
                          class="btn btn-primary w-100"
                          edit="<?=$d->codigo?>"
                          data-bs-toggle="offcanvas"
                          href="#offcanvasDireita"
                          role="button"
                          aria-controls="offcanvasDireita"
                        >
                          Editar
                        </button>
                      </div>
                      <div class="col-6 p-2">
                        <button class="btn btn-danger w-100" delete="<?=$d->codigo?>">
                          Excluir
                        </button>
                      </div>
                    </div>
                  </div>
                <?php
                  }
                ?>
            </div>


          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<script>
    $(function(){
        Carregando('none');

        $("button[novoCadastro]").click(function(){
            $.ajax({
                url:"src/usuarios/form.php",
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        

        $("button[filtro]").click(function(){
          filtro = $(this).attr("filtro");
          campo = $("input[campoBusca]").val();
          $.ajax({
              url:"src/usuarios/index.php",
              type:"POST",
              data:{
                  filtro,
                  campo
              },
              success:function(dados){
                  $("#paginaHome").html(dados);
              }
          })
        })


        $("button[edit]").click(function(){
            cod = $(this).attr("edit");
            $.ajax({
                url:"src/usuarios/form.php",
                type:"POST",
                data:{
                  cod
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        

        $("button[delete]").click(function(){
            deletar = $(this).attr("delete");
            $.confirm({
                content:"Deseja realmente excluir o cadastro ?",
                title:false,
                buttons:{
                    'SIM':function(){
                        $.ajax({
                            url:"src/usuarios/index.php",
                            type:"POST",
                            data:{
                                delete:deletar
                            },
                            success:function(dados){
                                $("#paginaHome").html(dados);
                            }
                        })
                    },
                    'NÃO':function(){

                    }
                }
            });

        })


        $(".situacao").change(function(){

            situacao = $(this).attr("usuario");
            opc = false;

            if($(this).prop("checked") == true){
              opc = '1';
            }else{
              opc = '0';
            }


            $.ajax({
                url:"src/usuarios/index.php",
                type:"POST",
                data:{
                    situacao,
                    opc
                },
                success:function(dados){
                    // $("#paginaHome").html(dados);
                }
            })

        });

    })
</script>