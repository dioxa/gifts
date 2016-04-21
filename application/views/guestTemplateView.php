<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Главная</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .but{
                border: 0px;
                padding-top: 3px;
                margin: 0px;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                    <ul class="nav navbar-toggle but collapsed" data-toggle="collapse">
                        <li><a href="/registration">Зарегистрироваться</a></li>
                    </ul>

                <a class="navbar-brand" href="/">Сервис подарков</a>
            </div>


            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" >
                    <li><a href="/registration">Зарегистрироваться</a></li>
                </ul>
            </div>
        </div>
    </nav>

        <?php
            include 'application/views/'.$content_view;
        ?>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
</body>
</html>