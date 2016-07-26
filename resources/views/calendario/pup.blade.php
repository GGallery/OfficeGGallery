<div class="pup">

    <div class="panel panel-default" style="min-height: {{$pup->n_ore * 50  }}">
        <div class="panel-heading" style="background: {{ $pup->commessa->colore }} ">
            <h3 class="panel-title"> {{ $pup->commessa->protocollo }} ({{ $pup->n_ore }})

                <a href="calendario/{{ $pup->id}}/destroy" data-method="delete" data-token="{{ csrf_token() }}">
                    <span class="glyphicon glyphicon-trash pull-right" aria-hidden="true"></span>
                </a>

            </h3>
        </div>
        <div class="panel-body ">{{ $pup->commessa->oggetto }}  </div>
    </div>

</div>