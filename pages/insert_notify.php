<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Входящее заявление</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootcomplete.css">
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap-typeahead.min.js"></script>
    <link href="../css/style.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container">
    <form class="form-horizontal" method="post" action="" name="notification">
        <div class="row">
            <div class="col-lg-4 col-md-1 col-sm-5 col-xs-5">
                <div class="form-group">
                    <input type="text" class="form-control" name="number_polis" id="number_polis"
                           placeholder="Номер полиса">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="col-lg-4 col-md-1 col-sm-5 col-xs-5">
                <div class="form-group">
                    <select class="custom-select form-control" id="prefix" name="prefix">
                        <option selected="selected">Метод подачи заявления</option>
                        
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>