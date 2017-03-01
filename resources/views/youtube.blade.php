<?php
/**
 * task main page
 */
?>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Youtube task</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Styles -->
        <style>
            .title {
                font-size: 84px;
            }
            .content{
                width: 100%;
                padding-left: 50px;
                padding-top: 30px;
                padding-right: 30px;
            }

        </style>
    </head>
    <body>
        <div class="">
            <div class="content">
                <h4>Для корректной работы требуется установить google API Key в AppModel</h4>
                <h6>В качестве примера можно ввеести google в строке поиска</h6>
                <form action="/">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        Поиск видео пользователя: {{ $username }}
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="search" class="form-control" value="{{ $username }}" placeholder="input users name..." />
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-success" value="search" />
                        </div> 
                    </div>
                    <div class="row">
                        <h3>Список найденных видео:</h3>
                        <div class="profile">
                            @if (count($data) > 0)
                            @foreach ($data as $i)
                            <p>Название: {{ $i['title'] }}</p>
                            <hr>
                            <p>Описание: {{ $i['description'] }}</p>
                            @endforeach
                            @else
                            Список пуст
                            @endif
                        </div>                       
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>
