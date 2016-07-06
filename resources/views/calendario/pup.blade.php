<div class="pup"> 

            <div class="panel panel-default">
                <div class="panel-heading" style="background: {{ $pup->commessa->colore }} ">
                    <h3 class="panel-title"> {{ $pup->commessa->protocollo }} {{ $pup->n_ore }}  

                    <a href="commesse/destroy?id=255"> 
                     <span class="glyphicon glyphicon-trash pull-right" aria-hidden="true"></span>
                     </a>    
 {{ Form::open([  'method' => 'DELETE', 'route' => ['commesse.destroy', $pup->id] ]) }}  
 {{ Form::submit('Cancella', ['class' => 'btn btn-danger']) }}  
 {{ Form::close() }} 



                    </h3>
                </div>
                <div class="panel-body heigh1">{{ $pup->commessa->oggetto }}  </div>
            </div>

        </div>