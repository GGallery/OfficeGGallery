@extends('layouts.dashboard')
@section('page_heading','Inserisci nuovo cliente')


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

        {{ Form::open(
        [  'url' =>'clienti/'])
        }}

        <div class="row">

            <div class="col-md-6">


                <div class="form-group">
                    {{ Form::label('nome', 'Nome cliente:') }}
                    {{ Form::text('nome', null, ['class' => 'form-control']) }}
                </div>


            </div>

        </div>


        <div class="pull-right" id="q">
            {{ Form::submit('inserisci', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
        </div>


    </div>
@stop