<!DOCTYPE html>
<html lang="pt">
    <head>


        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SMS</title>


        <link rel="stylesheet" type="text/css"  href="css/index.css" />
        <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/index.css">

        <script src="plugins/jquery/jquery-1.10.2.js"> </script>
        <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/script.js"> </script>

        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li><a href="config.php">Importação</a></li>
                  <!--  <li class="navbar-right"><a href="#">Sair</a></li>-->
                </ul>
            </div>
        </nav>
    </head>

    <body>




    <div id="alert" class="alert alert-danger alert-dismissible center-block " role="alert" style="width: 50%; display: none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong></strong>
    </div>


        <div class="container" id="div-sms-read-container" >
            <div class="row">
                    <textarea id="txt-sms-read" maxlength="150"></textarea>
            </div>

            <div class="row">
                <label id="lb-qtd-char">0 de 150 caracteres</label>
            </div>

            <div class="row">
                   <div class="center-block" style="max-width: 600px; min-width: 50px"  >
                       <div class="progress">
                           <div id="div-progress-bar-sms-progress" class="progress-bar" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                               0%
                           </div>
                       </div>
                   </div>
            </div>

            <div class="row">
                <div class="row row-center ">

                    <div class="col-lg-12">
                        <button id="btn-start-stop" class="btn btn-lg btn-success" state="stopped">Iniciar</button>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="row left">
                <div class="panel panel-default" style="width: 50%; margin-left: auto;margin-right: auto">
                    <div class="panel-body text-center">
                        Registros no Banco de Dados
                    </div>

                    <div class="panel-footer">

                        <ul class="list-group text-left">
                            <li class="list-group-item list-group-item-info"><strong>A enviar</strong> <span id="badge-to-send" class="badge">0</span></li>
                            <li class="list-group-item list-group-item-success"><strong>Enviadas</strong><span id="badge-sent" class="badge">0</span></li>
                            <li class="list-group-item list-group-item-danger"><strong>Erros</strong><span id="badge-error" class="badge">0</span></li>
                            <li class="list-group-item "><strong>Total</strong><span id="badge-total" class="badge">0</span></li>
                        </ul>

                        <label id="lb-qtd-sent"></label>
                    </div>


                </div>


            </div>

        </div>













    </body>


</html>
