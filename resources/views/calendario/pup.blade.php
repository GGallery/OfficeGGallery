<div class="pup">

    <div class="panel panel-default"
         style="
                 min-height: {{$pup->n_ore * 80  }};
                 background: {{ $pup->commessa->colore }}" >
        <div class="panel-body">

            {{ $pup->commessa->protocollo }} ({{ $pup->n_ore }} ore)

            <a href="calendario/{{ $pup->id}}/destroy" data-method="delete" data-token="{{ csrf_token() }}">
                <span class="glyphicon glyphicon-trash pull-right" aria-hidden="true"></span>
            </a>
            <br>
            @if($pup->type==5)
                <button class="btn btn-warning btn-xs" type="button">RECUPERO-</button>
            @endif

            @if($pup->type==4)
                <button class="btn btn-warning btn-xs" type="button">RECUPERO+</button>
            @endif

            @if($pup->type==7)
                <button class="btn btn-default btn-xs" type="button">TRASFERTA</button>
            @endif

            @if($pup->approvato != 1)
                <button class="btn btn-danger btn-xs" type="button">DA APPROVARE</button>
            @endif
            <br>
            {{ $pup->commessa->oggetto }}


        </div>
    </div>


</div>