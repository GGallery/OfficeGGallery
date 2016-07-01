@extends('layouts.dashboard')
@section('page_heading','Inserisci commessa')


@section('section')


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


    {{ Form::open(['url' =>'calendario']) }}


    <div class="form-group">
        {{ Form::label('dipendenti_id', 'Dipendente:') }}
        {{ Form::text('dipendente_id', null, ['class' => 'form-control']) }}
    </div>



    <div class="form-group">
        {{ Form::label('commessa_id', 'Commessa:') }}

        {{ Form::text('commessa_id', null, ['class' => 'form-control']) }}
    </div>



    <div class="pull-right">
        {{ Form::submit('invia', ['class' => 'btn btn-success']) }}

        {{ Form::close() }}
    </div>



    @stop
