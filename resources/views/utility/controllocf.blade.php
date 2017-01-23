@extends('layouts.dashboard')
@section('page_heading','Verifica codici fiscali')


@section('section')

    {{   Form::open(['method' => 'post' , 'url' => 'controllocf'])   }}

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('elencocf', 'Incolla qui tutti i codici fiscali da controllare. :') }}
                {{ Form::label('elencocf2', '(puoi copiare l\'elenco direttamente da excel e incollarlo qui. I CF devono essere uno per ogni riga.') }}
                {{ Form::textarea('elencocf', null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{ Form::submit('Invia ', ['class' => 'btn btn-success']) }}
                {{ Form::close() }}
            </div>

        </div>

        <div class="col-md-6">
            @if(count($data) > 0)
                <h2>Elenco codici fiscali errati ({{ count($data)}})</h2>
                <table class="table  table-striped" >
                    @foreach($data as $single)
                        <tr>
                            <td>{{ $single['cf']}}</td>
                            <td>{{ $single['msg']}}</td>
                        </tr>
                    @endforeach
                </table>
        </div>

        @else
            <h2>Non ci sono codici fiscali errati</h2>
        @endif

    </div>
@stop