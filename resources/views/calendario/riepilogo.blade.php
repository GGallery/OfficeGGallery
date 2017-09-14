@extends('layouts.dashboard')
@section('page_heading','Riepilogo Recupero/Ferie/Permessi')


@section('section')


    <div class="row">
        <div class="col-sm-12">


            <table class="table table-striped">

                <thead>  <tr>
                    <th>Data</th>
                    <th>Commessa</th>
                    <th>Protocollo</th>
                    <th>Cliente</th>
                    <th>Azione</th>
                    <th>N° ore</th>
                    <th>Stato</th>
                    <th>Rilevato</th>

                </tr>
                </thead>
                <tbody>

                @foreach($riepilogo as $single)

                    <tr >
                        <td>{{ $single->giorno}}</td>
                        <td>{{ $single->commessa->oggetto}}</td>
                        <td>{{ $single->commessa->protocollo}}</td>
                        <td>{{ $single->commessa->clienti->nome}}</td>
                        <td>
                            @if($single->type==1) Feria @endif
                            @if($single->type==2) Permesso @endif
                            @if($single->type==3) Straordinario @endif
                            @if($single->type==4) Recupero+ @endif
                            @if($single->type==5) Recupero- @endif
                            @if($single->type==6) Malattia/Mutua @endif
                            @if($single->type==7) Trasferta @endif
                        </td>
                        <td>{{ $single->n_ore}}</td>
                        <td>
                            @if($single->approvato==1) Approvato @else Da approvare @endif
                        </td>
                        <td>

                            @if(
                            $single->type == 1 ||
                             $single->type == 2 ||
                             $single->type == 3 ||
                             $single->type == 6 ||
                             $single->type == 7
                            )
                            @if($single->rilevato == null )  Da rilevare @else Rilevato il {{$single->rilevato }} @endif
                            @else
                                -
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>




        </div>
    </div>




@stop