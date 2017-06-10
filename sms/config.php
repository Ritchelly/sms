<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="plugins/jquery/jquery-1.10.2.js"></script>
    <script src="plugins/bootstrap/dist/js/bootstrap.js"></script>
    <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


    <script src="js/config.js"></script>

    <link rel="stylesheet" type="text/css"  href="css/config.css" />

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Início</a></li>
               <!-- <li class="navbar-right"><a href="#">Sair</a></li>-->
            </ul>
        </div>
    </nav>

</head>

<body>

<div class="panel panel-default" style="width: 50%; margin-left: auto;margin-right: auto">
    <div class="panel-body text-center">
        Configurações de Importação
    </div>

    <div class="panel-footer">
        <div class="row center-block">

            <div class="col-lg-10">
                <div class="input-group">
                                    <span class="input-group-btn">
                                         <span class="btn btn-primary btn-file">
                                          Buscar &hellip; <input type="file" name="arquivo" id="arquivo" multiple>
                                         </span>
                                    </span>
                    <input type="text" id="txt-get-file" class="form-control" readonly>
                </div>
            </div>

            <div class="col-lg-1">
                <input type="submit" value="Enviar Arquivo" class="btn btn-primary  "  id="btn-enviar-arquivo" disabled/>
            </div>

        </div>
<!--
        <div class="row" style="padding-top: 15px">
            <div class="center-block" style="max-width: 600px; min-width: 50px"  >
                <div class="progress">
                    <div id="div-progress-bar-import-progress" class="progress-bar" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        0%
                    </div>
                </div>
            </div>
        </div>
-->
        <div class="row text-center" style="padding-top: 20px;">
                <input type="submit" value="Importar Dados" class="btn btn-primary  " id="btn-importar-dados" disabled />
        </div>


    </div>

</div>


<div class="panel panel-default" style="width: 50%; margin-left: auto;margin-right: auto">
    <div class="panel-body text-center">
       Registros no Banco de Dados
    </div>

    <div class="panel-footer">
        <div class="row center-block">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info"><strong>A enviar</strong> <span id="badge-to-send" class="badge">0</span></li>
                <li class="list-group-item list-group-item-success"><strong>Enviadas</strong><span id="badge-sent" class="badge">0</span></li>
                <li class="list-group-item list-group-item-danger"><strong>Erros</strong><span id="badge-error" class="badge">0</span></li>
                <li class="list-group-item "><strong>Total</strong><span id="badge-total" class="badge">0</span></li>
            </ul>
            <input type="submit" value="Excluir Dados" class="btn btn-danger center-block "  id="btn-delete-db" />
        </div>
    </div>

</div>


</body>
</html>