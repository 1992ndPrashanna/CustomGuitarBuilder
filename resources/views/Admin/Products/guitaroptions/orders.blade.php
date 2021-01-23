{{-- see all custom orders placed by customers --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Guitars / View All Orders') }}
        </h2>
    </x-slot>
    @php
        
    @endphp
    <style>
        table tbody tr td {
            height:80px;
        }

        .uuid-data{
            width:300px;
            padding:0px;
        }

        /* create table class instead of HTML table */
            .new-table {
                display: table;
            }
            .new-row {
                display: table-row;
            }
            .new-cell {
                display: table-cell;
            }
        /* end table class */

    </style>
    <x-guitar-options-bar/> 
    <div class="col-md-11 mx-auto mt-10">
        <div class="row">

                <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>
                                Order Number
                            </th>
                            <th>
                                Customer Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Order UUID
                            </th>
                            <th>
                                Details
                            </th>
                            <th>
                                Current Quoted Price
                            </th>
                            <th>
                                Price
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    {{$order->id}}
                                </td>
                                <td>
                                    {{$order->getCustomer->first_name." ".$order->getCustomer->last_name}}
                                </td>
                                <td>
                                    {{$order->user_email}}
                                </td>
                                <td class="uuid-data">
                                    <div id="{{$order->id}}" class="order-uuid" style="display:none;padding:0px;margin:0px;">
                                        {{$order->orderUUID}}
                                    </div>
                                    <button id="showUUID" class="btn btn-sm btn-danger" onclick="showUUID({{$order->id}})">Show</button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#{{'showCustomer'.$order->id}}">
                                        Customer Details
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#{{'showOrder'.$order->id}}">
                                        Order Details
                                    </button>
                                </td>
                                <td>
                                    @if ($order->price!="")
                                        {{$order->price}}
                                    @else
                                        <b>Pending</b>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#{{'addPrice'.$order->id}}">Add Price</button>
                                </td>
                            </tr>

                            {{-- customer details modal --}}
                            <div class="modal fade" id="{{'showCustomer'.$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mx-auto">
                                            <p>
                                                <b>Customer Name</b> : {{$order->getCustomer->first_name." ".$order->getCustomer->last_name}}
                                            </p>
                                            <p>
                                                <b>Address Info</b> : {{$order->getCustomer->street_address.", ".$order->getCustomer->city.", ".$order->getCustomer->country}} <br>
                                                <b>ZIP/Postal Code</b> : {{$order->getCustomer->zip_postal_code}}
                                            </p>
                                            <p>
                                                <b>Contact Info</b><br>
                                                <b>Email</b>: {{$order->getCustomer->email}}<br>
                                                <b>Phone Number</b> : {{$order->getCustomer->phone}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                                      
                                    </div>
                                  </div>
                                </div>
                            </div>
                            {{-- end customer details modal --}}

                            {{-- order detail modal --}}
                            <div class="modal fade" id="{{'showOrder'.$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12 mx-auto">
                                            <div class="table">
                                                <div class="row">
                                                    <div class="cell">
                                                        Model : {{$order->getCustomOrder->model->type}} 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="cell">
                                                        Body Wood : {{$order->getCustomOrder->bodyWood->type}} 
                                                    </div>
                                                    <div class="cell">
                                                        Top Wood : {{$order->getCustomOrder->topWood->type}} 
                                                    </div>
                                                    <div class="cell">
                                                        Neck: {{$order->getCustomOrder->neck_pieces." Piece, ".$order->getCustomOrder->neckType->type.", "}}@php
                                                            echo $order->getCustomOrder->neckWoods->neck_woods;
                                                        @endphp                                                     
                                                    </div>
                                                    <div class="cell">
                                                        Fretboard Wood : {{$order->getCustomOrder->fretboardWood->type}} 
                                                    </div>
                                                    <div class="cell">
                                                        Top Wood : {{$order->getCustomOrder->->type}} 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            {{-- end order details modal --}}
                            {{-- add price modal --}}
                            <div class="modal fade" id="{{'addPrice'.$order->id}}" tabindex="-1" aria-labelledby="addPriceModal" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="addPriceModal">Add Price for Order No. {{$order->id}}</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('/guitar/addPrice/'.$order->orderUUID)}}" method="POST">
                                            @csrf
                                          <div class="mb-3">
                                              <label for="price" class="form-label">Add Price</label>
                                              <input type="text" class="form-control" name="price" id="price">
                                          </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-success">Add Price</button>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              {{-- end add price modal --}}
                        @endforeach
                    </tbody>
                </table>
         

        </div>
    </div>


    <script>
        function showUUID(id){
            var uuid=document.getElementById(id);
            var button=document.getElementById("showUUID");
            if(uuid.style.display=="none"){
                uuid.style.display="block";
                button.innerHTML="Hide";
            }
            else{
                uuid.style.display="none";
                button.innerHTML="Show";
            }
            
        }
    </script>
</x-app-layout>