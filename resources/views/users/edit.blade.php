@extends('layouts.dashboard')
@section('page_heading','Dipendenti')

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

    {{ Form::model($datiRecuperati,
    ['method' => 'put', 'url' =>'users'. $datiRecuperati['id']])
    }}

    <div class="form-group">
        {{ Form::label('nome', 'Il tuo nome:') }}
        {{ Form::text('nome', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('cognome', 'Il tuo cognome:') }}
        {{ Form::text('cognome', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'La tua email:') }}

        {{ Form::text('email', null, ['class' => 'form-control']) }}
    </div>

    <div class="pull-right">
        {{ Form::submit('aggiorna', ['class' => 'btn btn-success']) }}

        {{ Form::close() }}

        {{ Form::open([
        'method' => 'DELETE',
        'url' => ['users', $datiRecuperati['id']]
        ]) }}
        {{ Form::submit('Cancella', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
    </div>
</div>


    @stop