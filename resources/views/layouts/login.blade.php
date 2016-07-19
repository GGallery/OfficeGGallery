<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <title>GAP</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="GGAP"/>
        <meta content="" name="Antonio Giangravè"/>

        <link rel="stylesheet"href="//codeorigin.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

        <link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />
    </head>
    <body>

        <div class="backstretch-item" style="position: absolute; margin: 0px; padding: 0px; border: medium none; width: 100%; height: 100%; z-index: -999999;">
            <img style="position: absolute; margin: 0px; padding: 0px; border: medium none; width: 1903px; height: 1124.18px; max-width: none; left: 0px; right: auto; bottom: auto;" alt="" src="https://source.unsplash.com/user/driesvints/likes">
        </div>
        <br><br><br>

        @yield('body')



        <script>var APP_URL = {{ json_encode(url('/')) }} ;
        
        </script>
        <script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
        <script src="//codeorigin.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>

        @yield('script')

    </body>
</html>