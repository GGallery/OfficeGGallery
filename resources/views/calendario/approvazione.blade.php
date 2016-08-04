@extends('layouts.dashboard')
@section('page_heading','Approvazioni')


@section('section')


<div class="row">
    <div class="col-sm-12">


        <table class="table table-striped">

            <thead>  <tr>
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th>Commessa</th>
                    <th>Azione</th>
                    <th>Giorno</th>
                    <th>Num ore</th>
                    <th></th>

                    <th> </th>
                </tr>
            </thead>
            <tbody>

                @foreach($approvazioni as $single)

                <tr>
                    <td>{{ $single->user->cognome}}</td>
                    <td>{{ $single->user->nome}}</td>
                    <td>{{ $single->commessa->oggetto}}</td>
                    <td>{{ $single->type   }}</td>
                    <td>{{ $single->giorno}}</td>
                    <td>{{ $single->n_ore}}</td>
                    <td>
                        {{Form::open(['method' => 'put', 'url' =>'calendario/'.$single->id] ) }}
                        {{ Form::submit('Approva', ['class' => 'btn btn-success']) }}
                        {{ Form::close() }}
                    </td>


                </tr>

                @endforeach

            </tbody>


        </table>
    </div>
</div>




@stop