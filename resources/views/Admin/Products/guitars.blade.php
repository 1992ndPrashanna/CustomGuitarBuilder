@php
use app\http\controllers\GuitarsController;
@endphp
<style>
table tr td {
        max-width: 400px;
        max-height:80px;
        overflow-x:hidden;
        overflow-y: hidden;
        padding:0px;
        margin:0px;
    }

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products /') }} @php
            echo GuitarsController::getProductName()."s";
            @endphp
        </h2>
    </x-slot>

    <x-guitar-options-bar/>
    @php
        $i=0;
    @endphp
    <div class="container-fluid">        
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="row">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          @foreach ($shapes as $shape)
                            <a class="nav-link @php if($i==0)  echo 'active'; @endphp" id="nav-<?php echo str_replace(' ','',$shape->type); ?>-tab" data-bs-toggle="tab" href="#nav-<?php echo str_replace(' ','',$shape->type); ?>" role="tab" aria-controls="nav-<?php echo str_replace(' ','',$shape->type); ?>" aria-selected="<?php if($i==0) echo 'true'; else echo 'false'; ?>">{{$shape->type}}</a>    
                            <?php $i++; ?>
                          @endforeach                                                    
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent" style="overflow-y:scroll; overflow-x:scroll;">
                          @php
                              $i=0;
                              $shapes_array=array_keys($guitars_sorted_by_shape);                              
                          @endphp

                        @for($i=0;$i<(sizeof($shapes_array));$i++)

                        <div class="tab-pane fade @php if($i==0)  echo 'show active'; @endphp" id="nav-<?php echo str_replace(' ','',$shapes_array[$i]); ?>" role="tabpanel" aria-labelledby="nav-<?php echo str_replace(' ','',$shapes_array[$i]); ?>-tab">
                            {{-- content of model tab --}}
                            <h3 class="">All <i>{{$shapes_array[$i]}}</i> Guitars</h3>  
                            <div class="mb-3">
                            {{ $guitars_sorted_by_shape[$shapes_array[$i]]->links() }}    
                            </div>
                            <table class="table table-bordered" >
                                <thead class="table-dark">
                                    <tr>
                                        <th>Guitar ID</th>
                                        <th>Frets</th>
                                        <th>Fret Brand and Type</th>
                                        <th>Body Wood</th>
                                        <th>Body Finish</th>
                                        <th>Top Wood</th>
                                        <th>Top Finish</th>
                                        <th>Neck Pieces</th>
                                        <th>Neck Woods</th>
                                        <th>Neck Finish</th>
                                        <th>Color</th>
                                        <th>Fretboard</th>                                    
                                        <th>Inlays</th>
                                        <th>Custom Inlay</th>
                                        <th>Radius</th>
                                        <th>Scale Length</th>
                                        <th>Pickup Config</th>
                                        <th>Neck Pickup</th>
                                        <th>Middle Pickup</th>
                                        <th>Bridge Pickup</th>
                                        <th>Bridge</th>
                                        <th>Electronics</th>
                                        <th>Nut</th>
                                        <th colspan="2">Actions</th>
                                    </tr>   
                                </thead>
                                <tbody style="background-color: #fff;">                                    
                                    @foreach ($guitars_sorted_by_shape[$shapes_array[$i]] as $viewGuitar) 
                                    <tr>
                                        <td>
                                            {{$viewGuitar->id}}
                                        </td>
                                        <td>{{$viewGuitar->fret_count}}</td>
                                        <td>{{$viewGuitar->fretsType->fretBrand->name." ".$viewGuitar->fretsType->type}}</td>
                                        <td>{{$viewGuitar->bodyWood->type}}</td>
                                        <td>{{$viewGuitar->bodyFinish->type}}</td>
                                        <td>{{$viewGuitar->topWood->type}}</td>
                                        <td>{{$viewGuitar->topFinish->type}}</td>
                                        <td>{{$viewGuitar->neckWoods->piece}}</td>
                                        <td><?php echo $viewGuitar->neckWoods->neck_woods ?></td>
                                        <td>{{$viewGuitar->neckFinish->type}}</td>
                                        <td>
                                            @if ($viewGuitar->natural_finish!=0)
                                                Natural Finish
                                            @elseif ($viewGuitar->standard_color!=0)
                                                {{$viewGuitar->standardColor->type}}
                                            @elseif ($viewGuitar->translucent_color!=0)
                                                {{$viewGuitar->transColor->type}}
                                            @endif
                                        </td>
                                        <td>{{$viewGuitar->fretboardWood->type}}</td>
                                        <td>{{$viewGuitar->neckInlays->type}}</td>
                                        <td>
                                            <?php 
                                                if($viewGuitar->custom_inlay_option==0)
                                                    echo "<i>None</i>";                                                
                                                else
                                                    echo $viewGuitar->customInlayOption->type;
                                                
                                            ?>
                                        </td>

                                        <td>{{$viewGuitar->fretRadius->type}}</td>
                                        <td>{{$viewGuitar->scaleLength->type}}</td>
                                        <td>{{$viewGuitar->pickupConfiguration->type}}</td>
                                        <td>
                                            @if ($viewGuitar->neck_pickup!=0)
                                                {{$viewGuitar->neckPickup->name}}                                                    
                                            @else
                                                <i>N/A</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($viewGuitar->middle_pickup!=0)
                                                {{$viewGuitar->middlePickup->name}}                                                    
                                            @else
                                                <i>N/A</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($viewGuitar->bridge_pickup!=0)
                                                {{$viewGuitar->bridgePickup->name}}                                                    
                                            @else
                                                <i>N/A</i>
                                            @endif
                                        </td>
                                        <td>
                                            {{$viewGuitar->guitarBridge->bridgeBrand->name." ".$viewGuitar->guitarBridge->bridgeType->type." ".$viewGuitar->guitarBridge->bridgeColor->type}}
                                        </td>
                                        <td>{{$viewGuitar->guitarElectronics->type}}</td>
                                        <td>{{$viewGuitar->guitarNut->type}}</td>
                                        <td><a href="{{url('/products/guitars/edit/'.$viewGuitar->id)}}" class="btn btn-sm btn-info">Edit</a></td>
                                        <td><a href="{{url('/products/guitars/delete/'.$viewGuitar->id)}}" class="btn btn-sm btn-danger">Delete</a></td>
                                    </tr>
                                    @endforeach                                        
                                </tbody>
                            </table>
                        </div>                     
                        @endfor                     
                    </div>
                </div>
            </div>
    </div>
    </div>
</x-app-layout>
