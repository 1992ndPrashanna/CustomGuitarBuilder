@extends('layouts.frontend')
    @section('title')
        Done Payment - Sahana Guitars Made in Nepal
    @endsection

@section('content')
@php

@endphp
<div class="col-md-10 mx-auto" style="margin-top:10%;">
    <h3 style="text-align: center;">Payment for USD {{$paid_amount}} complete!</h3>
    <p class="mx-auto" style="text-align: center;">Dear, {{$getCustomer->first_name." ".$getCustomer->last_name}} , your payment was received successfully! <br>
    You were automatically logged out after your payment. <br>
     Please re-login to view your order-details.
    </p>
    <div class="d-flex justify-content-center my-5">
        <img class="mx-auto" src="{{asset('storage/misc_image/paid.png')}}" width="100" alt="">  
    </div>    
    <div class="d-flex justify-content-center">
        <button class="btn btn-lg btn-success" onclick="getHome()">Go to HomePage</button>
    </div>
    
</div>
<script>
    function getHome(){
        var homeURL="http://127.0.0.1:8000/";
        window.location.replace(homeURL);
    }
</script>
@endsection