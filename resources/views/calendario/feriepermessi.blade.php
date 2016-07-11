@extends('layouts.dashboard')
@section('page_heading','Ferie e Permessi')


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
        {{ Form::hidden('dipendenti_id', Auth::user()->id, ['class' => 'form-control', 'id' => 'dipendenti_id'  ]) }}
    </div>

    
    <div class="form-group">
        {{ Form::label('n_ore', 'Ferie:') }}
        {{ Form::radio('commessa_id', 1, ['id'=>'commessa_id' ,  'class' => 'form-control'  ]) }}
        {{ Form::label('n_ore', 'Permessi:') }}
        {{ Form::radio('commessa_id', 2, ['id'=>'commessa_id' ,  'class' => 'form-control'  ]) }}

    </div>

    <div class="form-group">
        {{ Form::label('n_ore', 'Numero ore:') }}
        {{ Form::text('n_ore', null, ['class' => 'form-control', 'placeholder' => 'per le mezzore inserisci  ,5']) }}
    </div>


    <div class="form-group">
        {{ Form::label('giorno', 'Giorno:') }}
        {{ Form::text('giorno', null, ['class' => 'form-control']) }}
    </div>





    <div class="pull-right">
        {{ Form::submit('Invia', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>

    @stop



        
@section('script')


   <script type="text/javascript">

            $( document ).ready(function() 
            {
             
                $("#commessa_id_text").autocomplete({
                    source: APP_URL+"/autocomplete/commesse",
                    minLength: 3,
                    select: function (event, ui) {
                        $('#commessa_id_text').val(ui.item.value);
                        $('#commessa_id').val(ui.item.id);
                    }
                });




    $( "#giorno" ).datepicker({
dateFormat: "yy-mm-dd",
changeMonth: true,
changeYear: true 

    });
    


            });



        </script>

@endsection
