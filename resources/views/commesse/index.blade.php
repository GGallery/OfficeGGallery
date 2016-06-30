@extends('layouts.dashboard')
@section('page_heading','Dipendenti')


@section('section')


<div class="row">
    <div class="col-sm-6">


        <table class="table table-striped">

            <thead>  <tr>  
                    <th>Nome</th> 
                    <th>Cognome</th> 
                    <th>Email</th>  
                    <th>Societa</th>  
                    <th> </th>  
                </tr>  
            </thead> 
            <tbody> 

                @foreach($data as $dip) 

                <tr> 
                    <td>{{ $dip->nome }}</td>
                    <td>{{ $dip->cognome }}</td>
                    <td>{{ $dip->email }}</td>
                    <td>{{ $dip->societa->societa }}</td>
                    <td><a class="btn btn-warning" href="dipendenti/{{$dip->id}}/edit">modifica</a></td>
                </tr>  

                @endforeach 

            </tbody> 


        </table>
    </div>
</div>




@stop