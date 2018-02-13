@extends('layouts.dashboard')
@section('page_heading','Generazione coupon Ausind')


@section('section')




    <style>


        label {
            display: inline-block;
            width: 200px;
            color:#666;
            font-weight: bold;
        }
        select,
        input {
            width: 450px;
        }
        strong {
            color:#000;
        }
        #form_container{
            background-color: #eee;
            width:80%;
            margin:auto;
            padding: 50px;
        }
        #left, #right {
            position: relative;
            float: left;
            width: 50%;
        }
    </style>

    <div id="left">

        <div id="form_container">
            <form id="coupon_form" method="post" action="index.php">
                <label>Ragione sociale</label><input type="text" name="ragione_sociale" placeholder="Ragione sociale dell'azienda"/><br />
                <label>Username</label><input type="text" name="piva" placeholder="Partita IVA dell'azienda"/><br />
                <label>E-Mail</label><input type="text" name="mail"  placeholder="Email del referente aziendale" /><br />
                <label>ATECO</label><input type="text" name="ateco"   placeholder="Necessario solo per SPI-WEB" /><br />
                <label>Corso</label>
                <select name="corso">
                    <option value="1" selected="selected">Formazione Generale dei Lavoratori [IT]</option>
                    <option value="2">Formazione Generale dei Lavoratori [EN]</option>
                    <option value="10">Dirigenti per la Sicurezza [IT]</option>
                    <option value="11">Aggiornamento - Videoterminalisti [IT]</option>
                    <option value="12">Universita'</option>
                    <option value="13">231 IIT [ITA]</option>
                    <option value="14">231 IIT [ENG]</option>
                    <option value="15">Aggiornamento - Ambienti di Lavoro e Rischio Interferenze</option>
                    <option value="16">Aggiornamento - Rischio Stress Lavoro Correlato</option>
                    <option value="18">Corso di formazione e informazione D. Lgs. 231/2001 - VTE - operai</option>
                    <option value="19">Corso di formazione e informazione D. Lgs. 231/2001 - VTE - impiegati</option>

                    <option value="20">Aggiornamento - Percezione del rischio</option>
                    <option value="21">Aggiornamento - Gestione delle emergenze</option>
                    <option value="22">Privacy</option>
                    <option value="23">Corso Aggiornamento per Lavoratori - Corso completo</option>
                    <option value="24">Formazione specifica rischio basso</option>

                    <option value="25">Progetto GAIA: allergie e intolleranze alimentari, celiachia</option>
                    <option value="26">Pillola di Aggiornamento - Rischio biologico e rischio chimico</option>
                    <option value="27">Corso di Formazione sul D. Lgs. 231/01 - Casa di Cura Villa Montallegro</option>
                    <option value="28">SmartWorking</option>
                    <option value="29">231 IIS</option>

                    <option value="101">Pacchetto Aggiornamento</option>
                    <option value="102">Pacchetto Cameo</option>
                    <option value="103">Pacchetto Ansaldo</option>




                </select><br />
                <label>Numero</label><input type="text" name="num" placeholder="Numero di coupon da produrre"/><br />
                <label>Attestato</label><input type="checkbox" name="attestato" checked="checked" /><br />
                <label>Venditrice</label>
                <select name="seller">
                    <option value="13_ausind">Ausind - Confindustria Genova</option>
                    <option value="14_assolombarda">Assolombarda</option>
                    <option value="18_uicuneo">UICuneo - Confindustria Cuneo</option>
                    <option value="20_legnano">Ali - Confindustria Alto Milanese</option>
                    <option value="32_artsana">ARTSANA</option>
                    <option value="51_confbergamo">Confindustria Bergamo</option>
                    <option value="60_unionservizi">Unionservizi - Confindustria La Spezia</option>
                    <option value="124_ggallery" selected="selected">GGallery</option>
                    <option value="143_cesisrl">CE.S.I - Confindustria Alessandria</option>
                    <option value="497_DeAGostini">DeAgostini</option>
                </select><br /><br />
                <div align="center">
                    <input type="submit" name="coupon-submit" value="Invia" />
                </div>
            </form>
        </div>
    </div>

    <div id="right">

        <div id="help">
            <ul>
                <li><strong>Ragione sociale:</strong> Nome dell'istituto o della società.</li>
                <li><strong>Username:</strong> Username dell'accout di amministrazine (in caso di azienda corrisponde alla partita iva).</li>
                <li><strong>E-Mail:</strong> indirizzo e-mail a cui verranno spediti i codici coupon.</li>
                <li><strong>Corso:</strong> per quale corso generare i codici coupon.</li>
                <li><strong>Numero:</strong> il numero di coupon vuoi generare.</li>
                <li><strong>Attestato:</strong> spuntare se il dipendente può scaricare l'attestato.</li>
                <li><strong>Venditrice</strong> chi ha venduto i codici coupon da generare. </li>
            </ul>
            <p>E clicca sul tasto <strong>Invia</strong> per ricevere l'email con i tuoi codici coupon.<br />
                I coupon generati sono anche automaticamente abilitati.</p>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#coupon_form').submit(function () {

                var values = {};
                $.each($('#coupon_form').serializeArray(), function (i, field) {
                    values[field.name] = field.value;
                });
                values['attestato'] = (typeof values['attestato'] == 'undefined') ? '0' : '1';

                if (!window.btoa) {
                    window.btoa = function (str) {
                        return Base64.encode(str);
                    }
                }
                var now = new Date();
                var dd = now.getDate();
                var mm = now.getMonth() + 1;
                var yyyy = now.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd;
                }
                if (mm < 10) {
                    mm = '0' + mm;
                }
                var today = yyyy.toString() + mm.toString() + dd.toString();
                now = yyyy + '-' + mm + '-' + dd;
                var rand = Math.floor(Math.random() * 100) + 1;
                var seller = values['seller'].split('_');
                var id_iscrizione = seller[1] + '-' + today + '-' + rand;


                var xml_gen_request = '<richiesta><id>' + seller[0] + '</id><id_iscrizione>' + id_iscrizione + '</id_iscrizione><id_corso>' + values['corso'] + '</id_corso><ragione_sociale>' + values['ragione_sociale'] + '</ragione_sociale><piva>' + values['piva'] + '</piva><coupon>' + values['num'] + '</coupon><email>' + values['mail'] + '</email><attestato>' + values['attestato'] + '</attestato></richiesta>';
                var xml_gen_request_str = btoa(xml_gen_request);

                //  var xml_ena_request = '<richiesta><id>'+seller[0]+'</id><id_iscrizione>'+ id_iscrizione +'</id_iscrizione><token>' + jQuery.md5(seller[1] + now) + '</token></richiesta>';
                var xml_ena_request = '<richiesta><id>' + seller[0] + '</id><id_iscrizione>' + id_iscrizione + '</id_iscrizione><token>' + now + '</token></richiesta>';
                var xml_ena_request_str = btoa(xml_ena_request);

                console.log(btoa(xml_ena_request_str));

                $.ajax({
                    url: "http://ausindfad.it/home/index.php?option=com_gglms&task=generatecoupon",
                    data: {data: xml_gen_request_str}
                }).complete(function () {

                    $.ajax({
                        url: "http://ausindfad.it/home/index.php?option=com_gglms&task=enablecoupon",
                        data: {data: xml_ena_request_str}

                    }).complete(function () {
                        alert('COUPON CREATI');
                    });
                });
                return false;
            });
        });
    </script>
@endsection
