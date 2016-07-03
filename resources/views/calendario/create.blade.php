@extends('layouts.dashboard')
@section('page_heading','Inserisci commessa')


@section('section')


 @if(count($errors->all()) > 0) 
  <div class="alert alert-danger" role="alert">  <p><b>OOOPS!</b></p> 
  <ul>  
  @foreach($errors->all() as $e)  
  <li>{{$e}}</li>  
  @endforeach  
  </ul> 
  </div>
   @endif


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


    {{ Form::open(['route' => 'calendario.store']) }}

 

 

    <div class="form-group">
        {{ Form::label('dipendenti_id', 'Dipendente:') }}
        {{ Form::text('dipendenti_id', null, ['class' => 'form-control']) }}
    </div>



    <div class="form-group">
        {{ Form::label('commessa_id_text', 'Commessa:') }}


        {{ Form::text('commessa_id_text', null, ['class' => 'form-control']) }}
        {{ Form::hidden('commessa_id', null, ['id'=>'commessa_id' ,  'class' => 'form-control']) }}
    </div>



    <div class="pull-right">
        {{ Form::submit('Invia', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>

    @stop



        
@section('script')

<script type="text/javascript">


console.log(APP_URL);
</script>



   <script type="text/javascript">

            $( document ).ready(function() 
            {
             //   var APP_URL = {{ json_encode(url('/')) };
              //  console.log(APP_URL);

                $("#commessa_id_text").autocomplete({
                    source: "../autocomplete/commesse",
                    minLength: 3,
                    select: function (event, ui) {
                        $('#commessa_id_text').val(ui.item.value);
                        $('#commessa_id').val(ui.item.id);
                    }
                });
            });



        </script>

@endsection
