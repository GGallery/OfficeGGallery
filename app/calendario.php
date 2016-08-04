<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calendario extends Model
{
    //
    protected $table="cm_calendario";

    public function commessa(){
        return $this->belongsTo('App\commesse' , 'commessa_id');
    }


    public function creditoRecuperi()
    {
//        SELECT tutti.* ,
//(RecuperiPOS - IFNULL(RecuperiNEG,0)) as credito,
//cm.oggetto
//FROM
//(
//    SELECT
//c.dipendenti_id,
//c.commessa_id,
//(SELECT SUM(n_ore) FROM cm_calendario as pp WHERE type  = 2 and pp.commessa_id = c.commessa_id and pp.dipendenti_id = c.dipendenti_id) as RecuperiPOS,
//(SELECT SUM(n_ore) FROM cm_calendario as pp WHERE type  = 3 and pp.commessa_id = c.commessa_id and pp.dipendenti_id = c.dipendenti_id) as RecuperiNEG
//FROM
//cm_calendario as c
//
//GROUP BY  dipendenti_id , commessa_id
//) as tutti
//LEFT JOIN cm_commesse as cm on tutti.commessa_id = cm.id
//WHERE  (RecuperiPOS - IFNULL(RecuperiNEG,0)) > 0


    }



}
