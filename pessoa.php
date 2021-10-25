<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <?php include_once "csscadastro.php"; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- jquery validation -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Controle cadastro pessoa</h3>
                                    </div>
                                   <!-- /.card-header -->
                                    <!-- form start -->
                                    <form name="form" method="post" id="form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php include_once "alerta.php"; ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cnpj">CPF | CNPJ *</label>
                                                <input required type="text" name="cnpj" class="form-control" id="cnpj" placeholder="Qual seu CPf ou CNPJ?">
                                            </div>
                                            <div class="form-group">
                                                <label for="rg_ie">RG | IE *</label>
                                                <input required type="text" name="rg_ie" class="form-control" id="rg_ie" placeholder="Qual seu RG ou IE?">
                                            </div>
                                            <div class="form-group">
                                                <label for="nome_fantasia">Nome | Nome fantasia *</label>
                                                <input required type="text" name="nome_fantasia" class="form-control" id="nome_fantasia" placeholder="Qual seu nome?">
                                            </div>
                                            <div class="form-group">
                                                <label for="razao_social">Sobre nome | Razão social *</label>
                                                <input required type="text" name="razao_social" class="form-control" id="razao_social" placeholder="Qual seu sobre nome ou razão social?">
                                            </div>
                                            <div class="form-group">
                                                <label for="data_inicio_atividade">Nascimento | Fundação *</label>
                                                <input required type="text" name="data_inicio_atividade" class="form-control" id="data_inicio_atividade" placeholder="Qual sua data?">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button id="btnsalvar" name="btnsalvar" type="button" class="btn btn-primary" >Salvar<i class="fas fa-save"></i> </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!--/.col (left) -->
                            <!-- right column -->
                            <div class="col-md-6">

                            </div>
                            <!--/.col (right) -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
            </div>
        </div>
    </div>
    <?php include_once "scriptcadastro.php"; ?>
    <script src="js/pessoa.js"></script>
</body>

</html>