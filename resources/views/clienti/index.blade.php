@extends('layouts.dashboard')
@section('page_heading','Clienti')


@section('section')


    <div class="row">
        <div class="col-sm-12">


            <table class="table table-striped">

                <thead>  <tr>
                    <th>#ID</th>
                    <th>Nome</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php $canedit = Auth::user()->hasAnyGroups('Admin'); ?>

                @foreach($data as $elemento)

                    <tr>
                        <td>{{ $elemento->id}}</td>
                        <td>{{ $elemento->nome}}</td>
                        <td>
                            @if($canedit)
                                <a class="btn btn-warning" href="clienti/{{$elemento->id}}/edit">modifica</a>
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>


            </table>
        </div>
    </div>




@stop