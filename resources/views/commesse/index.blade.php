@extends('layouts.dashboard')
@section('page_heading','Commesse')


@section('section')


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



    <div class="row">
        <div class="col-sm-12">
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

                <?php $canedit = Auth::user()->hasAnyGroups('Admin'); ?>
                @foreach($data as $val)
                    <tr>
                        <td>{{ $val->id }}</td>
                        <td>{{ $val->protocollo }}</td>
                        <td>{{ $val->clienti->nome }}</td>
                        <td>{{ $val->oggetto }}</td>
                        <td>{{ $val->stato }}</td>
                        <td>{{ $val->referente }}</td>
                        <td>
                            @if($canedit)
                                <a class="btn btn-warning" href="commesse/{{$val->id}}/edit">modifica</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $data->render() }}
        </div>
    </div>
@stop