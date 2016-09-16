@extends('layouts.dashboard')
@section('page_heading','Clienti')

@section('section')

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        @if(count($errors->all()) > 0)
            <div class="alert alert-danger" role="alert">
                <p><b>OOOPS!</b></p>
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{$e}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{
        Form::model($datiRecuperati,
        ['method' => 'put', 'url' =>'clienti/'. $datiRecuperati['id']])
        }}

        <div class="row">

            <div class="col-md-4">



                <div class="form-group">
                    {{ Form::label('nome', 'Nome cliente:') }}
                    {{ Form::text('nome', null, ['class' => 'form-control']) }}
                </div>


            </div>


        </div>


        <div class="pull-right">
            {{ Form::submit('aggiorna', ['class' => 'btn btn-success']) }}

            {{ Form::close() }}

            {{ Form::open([
            'method' => 'DELETE',
            'url' => ['clienti', $datiRecuperati['id']]
            ]) }}
            {{ Form::submit('Cancella', ['class' => 'btn btn-danger']) }}
            {{ Form::close() }}
        </div>
    </div>


@stop