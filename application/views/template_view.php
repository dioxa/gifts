<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Главная</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .header{
                padding-top: 10px;
                background: #222;
            }
        </style>
    </head>
    <body>
        <div class = "row header">
            <div class="col-lg-4">
                <a href="/profile/"><img src="../../uploads/logo.jpg" height="50"></a>
            </div>
            <div class="col-lg-4">
                <form method="POST" action="/search">
                    <input type="text" class="input-sm" name="username">
                    <button type="button" class="btn btn-primary btn-sm">Найти</button>
                </form>
            </div>
            <div class="col-lg-4">
                <div class = "col-lg-4">

                </div>
                <div class = "col-lg-4">
                    <a href = '/settings'>Настройки</a>
                </div>
                <div class = "col-lg-4">
                    <a href = '/login/logout'>logout</a>
                </div>
            </div>
        </div>
        <?php
            include 'application/views/'.$content_view;
        ?>
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>