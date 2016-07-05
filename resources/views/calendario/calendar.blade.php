@extends('layouts.dashboard')
@section('page_heading','La tua settimana')


@section('section')


@if(count($errors->all()) > 0) 
<div class="alert alert-danger" role="alert">  <p><b>OOOPS!</b></p> 
    <ul>  
        @foreach($errors->all() as $e)  
        <li>{{$e}}</li>  
        @endforeach  
    </ul> 
</div>
@endif


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">




    <div id="lun" class="col-xs-2 ">

        <div class="pup"> 

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ABBOT</h3>
                </div>
                <div class="panel-body heigh1">  </div>
            </div>

        </div>
        <div class="pup">LEVATI</div>
        <div class="pup">MARKETING</div>
        <div class="pup">PASSONI</div>





    </div>
    <div id="mar" class="col-xs-2 ">martedi</div>
    <div id="mer" class="col-xs-2 ">mercoledi</div>
    <div id="gio" class="col-xs-2 ">giovedi</div>
    <div id="ven" class="col-xs-2 ">venerdi</div>
    <div id="sab" class="col-xs-2 ">sabato</div>





</div>


@stop




@section('script')


<script type="text/javascript">

    $(document).ready(function ()
    {




    });



</script>

@endsection
