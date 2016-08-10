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
        {{
        Form::model($datiRecuperati,
        ['method' => 'put', 'url' =>'users/'. $datiRecuperati['id']])
        }}

        <div class="row">

            <div class="col-md-4">



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


            </div>



            <div class="col-md-4">


                <div class="form-group">
                    {{ Form::label('societa_id', 'Società di appartenenza:') }}
                    {{ Form::select('societa_id', $societa, null, ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('referente_id', 'Referente:') }}
                    {{ Form::select('referente_id', $leader,null ,['class' => 'form-control' ,

                    Auth::user()->hasAnyGroups('Admin')  ? '' :'disabled'    ]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('bloccato', 'Bloccato:') }}
                    {{ Form::select('bloccato', array(0 => 'No' , 1=> 'Si'),null ,['class' => 'form-control' ]) }}
                </div>



            </div>


            <div class="col-md-4">

                @if(Auth::user()->hasAnyGroups('Admin'))
                    {{ Form::label('Autorizzazioni', 'Gruppi:') }}
                    <div class='form-group'>
                        @foreach ($usergroups as $key => $val)
                            <br>
                            {{ Form::checkbox('groups[]', $key) }}
                            {{ Form::label('groups', $val) }}
                        @endforeach
                    </div>
                @endif

            </div>


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