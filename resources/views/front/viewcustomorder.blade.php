@extends('layouts.frontend')

@section('title')
    View Custom Order - Sahana Guitars
@endsection

@section('content') 
@php

    if($order->advanced_payment==0){
        $payable=.5*$order->due;
        $due=$order->price-$payable;
    }
    elseif($order->advanced_payment!=0){
        $payable=$order->due;
        $due=0;
    }

    $wireTransfer='<li>
                        <b>Wire Transfer</b><br>
                        <p>
                            <div>For <strong>Wire Transfer</strong>, you need following information:</div>
                            <ul>
                                <li><strong>Account Name </strong>:&nbsp;<strong>Sahana Guitars XXXXX</strong></li>
                                <li><strong>Address</strong>: Kathmandu, Nepal</li>
                                <li><strong>Account Details</strong>
                                    <ul>
                                        <li><strong>Account Number:</strong>&nbsp;<strong>XXXXXXX-XXX-XX</strong></li>
                                        <li><strong>Branch Name: XXXXXX</strong></li>
                                        <li><strong>Bank Name: XXXXX Bank</strong></li>
                                    </ul>
                                </li>
                                <li><strong>Phone :&nbsp;</strong>+977-98XXXXXXXX</li>
                                <li><strong>Email&nbsp;</strong>: customerelations1992@outlook.com</li>
                            </ul>
                        </p>
                    </li>';
@endphp

    <style>
            .custom-shop-gallery-header {
            font-family: 'Kanit', sans-serif;
            text-align: center;
        }

        .custom-shop-gallery-sub-header{
            font-family: 'Montserrat', sans-serif;;
            text-align: center;
        }

        .final-price {
            width: 50%;
            font-size: 25px;
        }

        .header-image {
            padding:50px;
            margin-top: 100px; 
            margin-bottom:20px; 
            background-repeat: no-repeat;       
            /* background-image: url({{asset('')}}); */
        }
        
    </style>
    {{-- payment failure modal --}}
    <div class="modal fade" id="failure-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment Cancelled!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            The payment was cancelled for some reason, please retry the payment method!
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('cancelled'))
    <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
        <strong>{{session('cancelled')}}</strong>
        <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>    
    @endif
    <div class="row header-image w-100">
            <img class="mx-auto" src="{{asset('storage/frontend_images/SGLogo.png')}}" alt="" style="width: 200px;">
            <h1 class="custom-shop-gallery-header">Sahana Guitars Custom Shop</h1>
            <h3 class="custom-shop-gallery-sub-header">Order Details</h3>

       
    </div>
    <div class="col-md-12" style="margin-bottom:100px;">
       <div class="row">
            <div class="col-md-4 mx-auto"  >
                Hello <b>{{$customer->first_name." ".$customer->last_name}}</b>! <button class="btn btn-sm btn-info" onclick="logout()">Logout</button><br>
                This is where you view your order details and total cost of your custom <b>{{$customOrder->model->type}}</b>!
                <hr>
                @if ($order->price=="")
                    <p>Unforunately, our team hasn't been able to determine the exact cost of your guitar as of yet.
                        But please stay assured, we are working as fast as we can to get back to you!
                    </p>
                @elseif($order->due==0)
                    <p>Your order has been fully paid for! <br>
                        We'll notify you when your order is shipped!
                        Thank you!
                    </p>
                
                @elseif($order->advanced_payment!=0)
                    <p>
                        You've already paid :<br>
                        <div class="my-3">
                            <input class="form-control" type="text" name="advanced-payment" value="{{'USD '.$order->advanced_payment}}" readonly>
                        </div>
                        You can pay the remaining amount at any time before the order ships. <br>
                        Please note that you <b>must</b> pay full amount before your order ships. <br>
                        You can use following payment methods: <br>
                    </p>
                    @php
                        echo $wireTransfer;
                    @endphp

                    <div id="paypal-button">

                    </div>
                @else
                    <p>Our team at Sahana Guitars has determined your custom guitar to cost:</p>
                    <form action="">
                        <input class="form-control final-price mx-auto" type="text" value="USD {{$order->price}}" readonly>
                        <div class="form-text">Inclusive of taxes/VAT. In case of international shipping, import fees may apply.</div>
                        <div class="form-text"></div>
                    </form>
                    <div class="my-5">
                        <b>NOTE:</b>
                        <p>You are only required to pay for 50% of USD <b>{{$order->price}}</b> in advance.<br><br>You can pay for your product by:</p>
                        <ol>
                            @php
                                echo $wireTransfer;
                            @endphp                                                        
                            <li><b>Use Paypal with your credentials </b><br>
                                <img src="{{asset('storage/misc_image/paypal.png')}}" width="100" alt="">
                                <form action="">
                                    <input type="hidden" name="payment" id="payment" value="paypal">
                                    <input type="hidden" class="form-control" name="firstname" id="firstname" value="{{$customer->first_name}}" readonly>
                                    <input type="hidden" class="form-control" name="lastname" id="lastname" value="{{$customer->last_name}}" readonly>
                                    <input type="hidden" class="form-control" name="country" id="country" value="{{$customer->country}}" readonly>
                                    <input type="hidden" cl ass="form-control" name="city" id="city" value="{{$customer->city}}" readonly>
                                    <input type="hidden" class="form-control" name="fullstreetaddress" id="fullstreetaddress" value="{{$customer->street_address}}" readonly>
                                    <input type="hidden" class="form-control" name="postalcode" id="postalcode" value="{{$customer->zip_postal_code}}" readonly>
                                    <input type="hidden" class="form-control" name="email" id="email" value="{{$customer->email}}" readonly>
                                    <input type="hidden" class="form-control" name="phone" id="phone" value="{{$customer->phone}}" readonly>
                                    
                                    <div id="paypal-button">

                                    </div>
                                </form>
                            </li>
                        </ol>
                        

                    </div>
                @endif
            </div>

            <div class="col-md-7 mx-auto">
                <h3 style="text-align: center">Invoice</h3>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Particular</th>    
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                
                                Sahana Guitars, Custom {{$customOrder->model->type}}<br>
                                
                            </td>
                            <td rowspan="2">
                                @if ($order->price!="")
                                {{$order->price}}    
                                @else
                                    Pending
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Specifications:<br>
                                <b>Model</b> : {{$customOrder->model->type}}<br>
                                <b>Body Wood</b> : {{$customOrder->bodyWood->type}}<br>
                                <b>Top Wood</b> : {{$customOrder->topWood->type}}<br>                    
                                <b>Neck Pieces and Woods</b> : {{$customOrder->neck_pieces." Piece, ".$customOrder->neckType->type.", "}}<br>
                                <b>Neck Attachment</b> : {{$customOrder->neckType->type}}<br>
                                <b>Fretboard Wood</b> : {{$customOrder->fretboardWood->type}}<br>
                                <b>Fretboard Radius</b> : {{$customOrder->fretRadius->type}}<br>
                                <b>Fretwire Type</b> : {{$customOrder->fretsType->fretBrand->name." ".$customOrder->fretsType->type}}<br>
                                <b>Inlays</b> : {{$customOrder->neckInlays->type}}<br>
                                <b>Custom Inlay</b> : @if ($customOrder->custom_inlay_option!=0) {{$customOrder->customInlayOption->type}} @else {{"None"}} @endif<br>
                                <b>Scale Length</b> : {{$customOrder->scaleLength->type}} <br>
                                <b>Pickup Configuration</b> : {{$customOrder->pickupConfiguration->type}}<br>
                                <b>Neck Pickup</b> : {{$customOrder->neckPickup->name}}<br>
                                <b>Middle Pickup</b> : {{$customOrder->middlePickup->name}}<br>
                                <b>Bridge Pickup</b> : {{$customOrder->bridgePickup->name}}<br>
                                <b>Bridge</b> : {{$customOrder->guitarBridge->bridgeColor->type." ".$customOrder->guitarBridge->bridgeBrand->name." ".$customOrder->guitarBridge->bridgeType->type}} <br>
                                <b>Electronics / Controls</b> : {{$customOrder->guitarElectronics->type}}<br>
                                <b>Nut</b> : {{$customOrder->guitarNut->type}}<br>
                                <b>Body Finish</b> : {{$customOrder->bodyFinish->type}}<br>
                                <b>Top Finish</b> : {{$customOrder->topFinish->type}} <br>
                                <b>Neck Finish</b> : {{$customOrder->neckFinish->type}}<br>
                                @if ($customOrder->natural_finish!=0)
                                    <b>Color</b> : Natural Finish <br>
                                @elseif($customOrder->standard_color!=0)
                                    <b>Color</b> : {{$customOrder->standardColor->type}}<br>
                                @else
                                    <b>Color</b> : {{$customOrder->transColor->type}}<br>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Total Price</b></td>
                            <td>
                                @if ($order->price!="")
                                {{$order->price}}
                                @else
                                    Pending
                                @endif
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
       </div>
    </div>        

    {{-- failure modal --}}
    
@php
    $orderUUID=$order->orderUUID;
    $email=$_GET['email'];    
@endphp

    @section('scripts')
        <script src="https://www.paypal.com/sdk/js?client-id=AZdpbVE-18g0G3OYJNllAvIMAVbE03YP-qEH9P6ktKAMMy3XmbE2kqE4JMcQXN1U8BvaXbT6I2RHc0hS&disable-funding=credit,card"></script>
        <script>
        // get variables
            var advancedPayment='<?php echo $order->advanced_payment?>';
            var guitarPrice=<?php echo $order->price ?>;
            var payable;
            var due=<?php echo $order->due ?>;
            
            if(advancedPayment==0){
                payable=.5*due;
                advancedPayment=payable;
                due=guitarPrice - payable;
            } 
            else if(advancedPayment!=0){
                payable=due;
                due=0;
            }

            // var totalPaid="<?php echo $payable; ?>";
            // var due="<?php echo $order->due-$payable; ?>";

            var successURL='http://127.0.0.1:8000/payment/done?uuid='+'<?php echo $order->orderUUID;?>&paid='+payable+'&due='+due; 
            var failureURL=document.getElementById('failure-modal');
            var logoutURL='http://127.0.0.1:8000/';
        paypal.Buttons({
            style:{
           color:'blue',
           shape:'pill'
            },
            createOrder:function(data,actions){
                return actions.order.create({
                    purchase_units:[{
                        amount:{
                            value:(payable)
                        }
                    }]
                });
            },
            onApprove: function(data,actions){
                return actions.order.capture().then(function(details){
                    window.location.replace(successURL);
                })
            },
            onCancel: function(data){
                $('#failure-modal').modal('show');
            }
        }).render('#paypal-button');

        function logout(){
            window.location.replace(logoutURL);
        }                
        
        </script>
    @endsection
@endsection