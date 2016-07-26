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


    <div class="col-xs-12 col-md-6">


        {{ Form::open(['route' => 'calendario.store']) }}

        <div class="form-group">
            {{ Form::hidden('dipendenti_id', Auth::user()->id, ['class' => 'form-control', 'id' => 'dipendenti_id'  ]) }}
        </div>


        <div class="form-group">
            {{ Form::label('commessa_id_text', 'Commessa:') }}
            {{ Form::text('commessa_id_text', null, ['class' => 'form-control', 'placeholder' => 'Inizia a scrivere 3 lettere e scegliene solo dall\'elenco']) }}
            {{ Form::hidden('commessa_id', null, ['id'=>'commessa_id' ,  'class' => 'form-control'  ]) }}

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

    </div>

    <div class=" col-md-4 col-md-offset-2">

        {{ Form::label('Ultime commesse usate') }}
        <div class="list-group">
            @foreach($mostUsed as $single)
                <a href="#"
                   commessa_id="{{ $single->commessa->id; }}"
                   commessa_text="{{ $single->commessa->oggetto; }}"
                   class="
                   list-group-item
                   mostUsed
                    @if($single->commessa->id>=1000)
                           list-group-item-warning
                           @endif
                           ">
                    {{ $single->commessa->oggetto; }}
                </a>
            @endforeach
        </div>
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


            $(".mostUsed").click(function() {
                $('#commessa_id_text').val($(this).attr("commessa_text"));
                $('#commessa_id').val($(this).attr("commessa_id"));

            });






            $( "#giorno" ).datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true

            });









        });



    </script>

@endsection
