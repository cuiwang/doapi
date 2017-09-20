<!DOCTYPE html>
<html>
    <head>
        <title>403</title>


        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">无权访问!</div>
                <br>
                <h1>403</h1>
            </div>
            <p> <a style=" color: #8d999e;" href="{{env('APP_URL')}}">{{env('APP_URL')}}</a></p>
        </div>
    </body>

    <script>
        setTimeout(self.location.href='{{env('APP_URL')}}',3000);
    </script>
</html>
