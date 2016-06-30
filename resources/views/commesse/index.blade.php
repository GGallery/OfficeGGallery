@extends('layouts.dashboard')
@section('page_heading','Commesse')


@section('section')
<div class="row">
    <div class="col-sm-6">
        <table class="table table-striped">
            <thead>  <tr>  
                    <th>id</th> 
                    <th>Protocollo</th> 
                    <th>Cliente</th>  
                    <th>Oggetto</th>  
                    <th>Stato</th>  
                    <th>Referente</th>  
                </tr>  
            </thead> 
            <tbody> 
                @foreach($data as $val) 
                <tr> 
                    <td>{{ $val->id }}</td>
                    <td>{{ $val->protocollo }}</td>
                    <td>{{ $val->clienti->nome }}</td>
                    <td>{{ $val->oggetto }}</td>
                    <td>{{ $val->stato }}</td>
                    <td>{{ $val->referente }}</td>
                    <td><a class="btn btn-warning" href="commesse/{{$val->id}}/edit">modifica</a></td>
                </tr>  
                @endforeach 
            </tbody> 
        </table>
        {{ $data->render() }}
    </div>
</div>
@stop