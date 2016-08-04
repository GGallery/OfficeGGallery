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
                    <th>Approva</th>

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


                    <td><a class="btn btn-warning" href="calendario/{{$single->id}}/edit">Approva</a></td>


                </tr>

                @endforeach

            </tbody>


        </table>
    </div>
</div>




@stop