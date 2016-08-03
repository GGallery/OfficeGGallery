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





    {{ Form::open(['route' => 'calendario.store']) }}

    <div class="form-group">
        {{ Form::hidden('dipendenti_id', Auth::user()->id, ['class' => 'form-control', 'id' => 'dipendenti_id'  ]) }}
        {{ Form::hidden('commessa_id_text', null, ['id'=>'commessa_id_text' , 'class' => 'form-control']) }}
        {{ Form::hidden('commessa_id', null, ['id'=>'commessa_id' ,  'class' => 'form-control'  ]) }}
    </div>

    <div class="col-xs-6">
        <div class="form-group">

            {{ Form::label('Scegli') }}

            @foreach($commesse_ferie_permessi as $single)

                {{Form::button($single->oggetto ,[
                'commessa_id' => $single->id,
                'commessa_text' => $single->oggetto,
                 'class' => "btn btn-warning ferieGroup"
                ])}}
            @endforeach

        </div>



        <div class="form-group">
            {{ Form::label('giorno', 'Giorno:') }}
            {{ Form::text('giorno', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('dalle_ore', 'Dalle ore:') }}
            {{ Form::select('dalle_ore', array(1,2,3,4,5,6,7,8,9) , null,['class' => 'form-control selectWidth' ]) }}
            {{ Form::select('dalle_minuti', array('0' => '00' , '30'=>' e mezza'),null,   ['class' => 'form-control']) }}

        </div>

        <div class="form-group">
            {{ Form::label('n_ore', 'Numero ore:') }}
            {{ Form::text('n_ore', null, ['class' => 'form-control', 'placeholder' => 'per le mezzore inserisci  ,5']) }}
        </div>

        <div class="pull-right">
            {{ Form::submit('Invia', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
        </div>

    </div>
@stop

@section('script')
    <script type="text/javascript">

        $( document ).ready(function()
        {

            $(".ferieGroup").click(function() {
                $('#commessa_id_text').val($(this).attr("commessa_text"));
                $('#commessa_id').val($(this).attr("commessa_id"));

            });


            $( "#giorno" ).datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true
            });


            $( "#n_ore" ).datepicker({
                dateFormat: "HH:MM",
                changeMonth: true,
                changeYear: true
            });


        });



    </script>

@endsection
