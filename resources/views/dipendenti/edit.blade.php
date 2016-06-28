<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Address Book</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a href="/agenda/create">Nuovo indirizzo</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="row">

{{ Form::open(array('url' => 'foo/bar')) }}


 <div class="form-group"> 
 {{ Form::label('nome', 'Il tuo nome') }} 
 {{ Form::text('nome', null, ['class' => 'form-control']) }}

 </div> 


    
{{ Form::close() }}



            </div>
        </div>




    </body>
</html>