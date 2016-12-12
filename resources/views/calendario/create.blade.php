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

    @if (session('ok_message'))
        <div class="alert alert-success">
            {{ session('ok_message') }}
        </div>
    @endif


    <div class="row">
        <div class="col-xs-12 col-md-6">




            {{ Form::open(['route' => 'calendario.store']) }}

            <div class="form-group">
                {{ Form::hidden('dipendenti_id', Auth::user()->id, ['class' => 'form-control', 'id' => 'dipendenti_id'  ]) }}
                {{ Form::hidden('dalle_ore', 0 ,['class' => 'form-control' ]) }}
            </div>


            <div class="form-group">
                {{ Form::label('commessa_id_text', 'Commessa:') }}
                {{ Form::text('commessa_id_text', null, ['class' => 'form-control', 'placeholder' => 'Inizia a scrivere 3 lettere e scegliene solo dall\'elenco']) }}
                {{ Form::hidden('commessa_id', null, ['id'=>'commessa_id' ,  'class' => 'form-control'  ]) }}

            </div>
            <div class="form-inline">
                <div class="form-group">
                    {{ Form::label('n_ore', 'Numero ore:') }}
                    {{ Form::select('n_ore',
                    array(
                    "0.5" => "0,5",
                    "1" => "1",
                    "1.5" => "1,5",
                    "2" => "2",
                    "2.5" => "2,5",
                    "3" => "3",
                    "3.5" => "3,5",
                    "4" => "4",
                    "4.5" => "4,5",
                    "5" => "5",
                    "5.5" => "5,5",
                    "6" => "6",
                    "6.5" => "6,5",
                    "7" => "7",
                    "7.5" => "7,5",
                    "8" => "8"
                    )
                    ,null, ['class' => 'form-control autoWidth']) }}




                    {{ Form::label('giorno', 'Giorno:') }}
                    {{ Form::text('giorno', null, ['class' => 'form-control autoWidth']) }}

                </div>
            </div>
            <div class="form-inline">
                <div class="form-group">

                    {{ Form::text('type_text', 'Commessa normale', ['class' => 'form-control ', 'id'=>'type_text', "disabled"]) }}
                    {{ Form::hidden('type', 0, ['class' => 'form-control' , 'id'=>'type'  ]) }}

                    {{ Form::label('cambia tipo:') }}

                    {{Form::button('Regolare' ,[
                             'type' => 0,
                             'type_text' => 'Commessa normale',
                              'class' => "btn btn-default type "
                             ])}}

                    {{Form::button('Recupero    +' ,[
                             'type' => 4,
                             'type_text' => 'Recupero+ ',
                              'class' => "btn btn-warning  type"
                             ])}}

                    {{Form::button('Straordinario' ,[
                             'type' => 3,
                             'type_text' => 'Straordinario ',
                              'class' => "btn btn-danger type "
                             ])}}

                    {{Form::button('Trasferta' ,[
                           'type' => 7,
                           'type_text' => 'Trasferta ',
                            'class' => "btn btn-primary type "
                           ])}}



                </div>
                <div class="pull-right">
                    {{ Form::submit('Invia', ['class' => 'btn btn-success']) }}
                    {{ Form::close() }}
                </div>
            </div>



        </div>

        <div class="hidden-xs col-md-4 col-md-offset-2">
            {{ Form::label('Ultime commesse usate') }}
            <div class="list-group">
                @foreach($mostUsed as $single)
                    <a href="#"
                       commessa_id="{{ $single->commessa->id; }}"
                       commessa_text="{{ $single->commessa->oggetto; }}"
                       class="
                   list-group-item
                   mostUsed
                   list-group-item-tiny
                               ">
                        {{ $single->commessa->oggetto; }}  ({{ $single->commessa->clienti->nome; }})
                    </a>
                @endforeach
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 ">
            {{ Form::open(['route' => 'calendario.index' , 'class' =>'form-inline pull-right' , 'method' => 'get']) }}
            {{ Form::text('giorno', null, ['class' => 'form-control', 'id' =>'giorno2', 'placeholder' => 'vai a...']) }}
            {{ Form::submit('vai al giorno', ['class' => 'btn btn-primary']) }}

            <a href="calendario?giorno={{ Session::get('prev') }}"><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-backward"></i></button></a>
            <a href="calendario?giorno={{ Session::get('next') }}"><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-forward "></i></button></a>
            <a href="calendario?giorno={{ Session::get('oggi') }}"><button type="button" class="btn btn-primary ">OGGI</button></a>

            {{ Form::close() }}
        </div>

    </div>
    <div class="row">

        <div id="calendario" class="col-xs-12">
            @foreach($settimana as $nome => $giorno)
                <div class="col-xs-2">
                    <div class="panel panel-default" style="height: 800px;" >
                        <div class="panel-heading">
                            <h3 class="panel-title"> {{ $nome }} <span class="pull-right badge"><b>{{  $totore[$nome]  }}   </b></span></h3>
                        </div>
                        <div class="panel-body">
                            @foreach($giorno as $pup)
                                @include('calendario.pup' , $pup)
                            @endforeach
                        </div>
                    </div>
                </div>
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

            $(".type").click(function(e) {
                e.preventDefault();
                $('#type_text').val($(this).attr("type_text"));
                $('#type').val($(this).attr("type"));
            });

//            $( "#giorno" ).datepicker({
//                dateFormat: "yy-mm-dd",
//                changeMonth: true,
//                changeYear: true
//            });

            $( "#giorno" ).datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                constrainInput: true,
                firstDay: 1
            });

            $( "#giorno2" ).datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                constrainInput: true,
                firstDay: 1
            });

            $('.alert-success').delay(5000).fadeOut('slow');

        });

    </script>

@endsection
