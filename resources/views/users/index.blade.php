@extends('layouts.dashboard')
@section('page_heading','Dipendenti')


@section('section')


<div class="row">
    <div class="col-sm-12">


        <table class="table table-striped">

            <thead>  <tr>  
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th>Email</th>  
                    <th>Societa</th>  
                    <th> </th>  
                </tr>  
            </thead> 
            <tbody>

            <?php $canedit = Auth::user()->hasAnyGroups('Admin'); ?>

                @foreach($data as $dip) 

                <tr> 
                    <td>{{ $dip->cognome }}</td>
                    <td>{{ $dip->nome }}</td>
                    <td>{{ $dip->email }}</td>
                    <td>{{ $dip->societa->societa }}</td>
                    <td>
                        @if($canedit)
                            <a class="btn btn-warning" href="users/{{$dip->id}}/edit">modifica</a>
                        @endif
                    </td>
                </tr>  

                @endforeach 

            </tbody> 


        </table>
    </div>
</div>




@stop