@extends('layouts.dashboard')
@section('page_heading','La tua settimana')
@section('action_button')
    {{ Form::open(['post' => 'calendar' , 'class' =>'form-inline']) }}


    {{ Form::text('giorno', null, ['class' => 'form-control', 'id' =>'giorno', 'placeholder' => 'vai a...']) }}
    {{ Form::submit('Invia', ['class' => 'btn btn-success']) }}
    {{ Form::close() }}

@stop

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






    <div id="calendario" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

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




        @stop

        @section('script')
            <script type="text/javascript">

                $(document).ready(function ()
                {
                    $( "#giorno" ).datepicker({
                        dateFormat: "yy-mm-dd",
                        changeMonth: true,
                        changeYear: true,
                        constrainInput: true
                    });
                });
            </script>
    </div>

@endsection
