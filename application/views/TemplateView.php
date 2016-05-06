<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Главная</title>
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Сервис подарков</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <form class="navbar-form navbar-left" role="search" method="post" name="username">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default">Поиск</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/settings">Настройки</a></li>
                    <li><a href="/login/logout">Выйти</a></li>
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