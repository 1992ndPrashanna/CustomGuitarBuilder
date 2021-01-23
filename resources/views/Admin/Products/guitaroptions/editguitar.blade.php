{{-- For Guitars --}}

<x-app-layout>
    {{-- 
        'brands','types','positions','activepassive','coverings','magnets'    
    --}}
    <style>
        table, th, td {
        border: 1px solid black;
    }
    table {
        background-color:#fff;
    }

    .btn-outline-success:hover {
        background-color:rgb(126, 241, 126);
    }

    /* required option */

    .required:after{
        content: '*';
        color: #e02b27;
        font-size: 1.5rem;
        margin: 0 0 0 5px;
    }

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Guitars / Add Guitar Option') }}
        </h2>
    </x-slot>
    <x-guitar-options-bar/>
    <div class="container-fluid">
        <div class="card col-md-10 mx-auto mt-10">
            <div class="card-header display-3"> <h3 class="card-title" style="font-size: 15px;">
                <b>Edit</b> "{{$editGuitar->neck_pieces." Piece Neck"}}                                
                @if ($editGuitar->natural_finish!=0)
                    <i>Natural Finish</i>
                @elseif($editGuitar->standard_color!=0)
                    <i>{{", ".$editGuitar->standardColor->type." "}}</i>
                @elseif($editGuitar->translucent_color!=0)
                    <i>{{", ".$editGuitar->transColor->type." "}}</i>
                @endif    
                {{", ".$editGuitar->topWood->type." Top "}}<b>{{$editGuitar->model->type. " No. ".$editGuitar->id}}</b>{{" with ".$editGuitar->neckPickup->name}}"
                </h3> 
            </div>
            <div class="card-body container-fluid col-md-8">
                <div class="mx-auto">
                    <div class="row">
                        {{-- images uploaded --}}
                        <div class="row">
                            <h1 style="text-align: center;"> Uploaded Images</h1>
                        </div>
                        
                        @php
                            $img_array=explode(',',$editGuitar->image_urls);
                            $loop_count=sizeof($img_array);
                            $i=0;
                        @endphp
                        <div class="row">
                            {{-- success_message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-success fade show w-100" role="alert">
                            {{session('success')}}
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                        @endif

                        @for($i=0;$i<$loop_count-1;$i++)
                        <div class="col-md-3">         
                            <form action="{{url('/products/guitars/removeimage/'.$editGuitar->id)}}" method="POST" enctype="multipart/form-data">
                                {{-- preview uploaded images --}}
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="row">
                                        
                                        <div class="col-md-5">
                                            <input type="hidden" name="id" value="{{$editGuitar->id}}">
                                            <input type="hidden" name="url" value="{{$img_array[$i]}}">
                                            <img src="{{asset($img_array[$i])}}" alt="" style="width:100%;">
                                        </div>
                                        
                                        
                                    </div>
                                        
                                    </div>
                                </div>                                
                            <button type="submit" class="btn btn-sm btn-danger my-2">Remove</button>
                            </form>
                        </div>
                        @endfor
                        {{-- end delete images --}}
                        <form action="{{route('guitar.update',$editGuitar->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Edit model --}}
                            <div class="my-3">
                                <label for="model" class="form-label">Selected Guitar Model</b></label>
                                <select class="form-select form-select-lg" name="model" id="model" onchange="getModelName(this);removeCustomInlaySelector();getNumberOfFrets(this)">
                                        <option value="{{$editGuitar->shape}}">{{$editGuitar->model->type}}</option>
                                    @foreach ($shapes as $shape)
                                        <option value="{{$shape->id}}">{{$shape->type}}</option>
                                    @endforeach                                
                                </select>     
                                <input type="hidden" id="frets" name="frets" value="{{$editGuitar->fret_count}}">         
                            </div>

                            {{-- Select bodywood --}}
                            <div class="my-3">
                                <label for="bodywood" class="form-label">Select <b>Body Wood</b></label>
                                <select class="form-select form-select-lg" name="bodywood" id="bodywood">
                                    <option value="{{$editGuitar->body_wood}}">{{$editGuitar->bodyWood->type}} - Selected</option>
                                    @foreach ($body_woods as $body_wood)
                                        <option value="{{$body_wood->id}}">{{$body_wood->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                             {{-- Select top wood --}}
                             <div class="my-3">
                                <label for="topwood" class="form-label">Select <b>Top Wood</b> (optional)</label>
                                <select class="form-select form-select-lg" name="topwood" id="topwood">
                                    <option value="{{$editGuitar->top_wood}}">{{$editGuitar->topWood->type}} - Selected</option>
                                    @foreach ($top_woods as $top_wood)
                                        <option value="{{$top_wood->id}}">{{$top_wood->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select Fretboard Wood --}}
                            <div class="mb-3">
                                <label for="fretboardwood" class="form-label required">Select <b>Fretboard/Fingerboard Wood</b></label>
                                <select class="form-select form-select-lg" name="fretboardwood" id="fretboardwood">
                                    <option value="{{$editGuitar->fret_wood}}">{{$editGuitar->fretboardWood->type}} - Selected</option>
                                    @foreach ($fretboard_woods as $fretboard_wood)
                                        <option value="{{$fretboard_wood->id}}">{{$fretboard_wood->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                            {{-- Select neck attachment --}}
                            <div class="mb-3">
                                <label for="neckattachment" class="form-label">Select <b>Neck Attachment</b></label>
                                <select class="form-select form-select-lg" name="neckattachment" id="neckattachment">
                                    <option value="{{$editGuitar->neck_type}}">{{$editGuitar->neckType->type}} - Selected</option>
                                    @foreach ($neck_types as $neck_type)
                                        <option value="{{$neck_type->id}}">{{$neck_type->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- select neck pieces --}}
                            <div class="mb-3">
                                <label for="neck" class="form-label required" >Select <b>Neck Pieces</b></label>
                                {{-- radio buttons  --}}
                                <div class="my-3">
                                    Neck Piece(s)
                                
                                    <input class="form-check-input" type="radio" name="piece" id="onepiece" value="1" onchange="getAllOnePieceNecks()"
                                    @php
                                        if($editGuitar->neck_pieces==1)
                                        echo 'checked';
                                    @endphp>
                                    <label class="form-check-label" for="onepiece">
                                    1-piece
                                    </label>
                                
                                    <input class="form-check-input" type="radio" name="piece" id="threepiece" value="3" onchange="getAllThreePieceNecks()"
                                    @php
                                        if($editGuitar->neck_pieces==3)
                                        echo 'checked';
                                    @endphp>
                                    <label class="form-check-label" for="threepiece">
                                    3-piece
                                    </label>
                                
                                    <input class="form-check-input" type="radio" name="piece" id="fivepiece" value="5" onchange="getAllFivePieceNecks()"
                                    @php
                                        if($editGuitar->neck_pieces==5)
                                        echo 'checked';
                                    @endphp>
                                    <label class="form-check-label" for="fivepiece">
                                    5-piece
                                    </label>
                                    
                                    <div class="my-3" id="neck-select-div" class="mx-auto">
                                        <input type="hidden" name="neckwoods" value="{{$editGuitar->neck_woods}}">
                                        
                                    </div>                                    
                                </div>
                            </div>
                            
                            {{-- Select Frets --}}
                            <div class="mb-3">
                                <label for="frettype" class="form-label">Select <b>Fretwire Type</b></label>
                                <select class="form-select form-select-lg" name="frettype" id="frettype">
                                    <option value="{{$editGuitar->frets_type}}">{{$editGuitar->fretsType->fretBrand->name." ".$editGuitar->fretsType->type}} - Selected</option>
                                    @foreach ($fret_types as $fret_type)
                                        <option value="{{$fret_type->id}}">{{$fret_type->fretBrand->name." ".$fret_type->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            <hr>
                            {{-- Select Inlays --}}
                            <div class="mb-3">
                                <label for="inlay" class="form-label">Select <b>Inlay</b></label>
                                <select class="form-select form-select-lg" name="inlay" id="inlay">
                                    <option value="{{$editGuitar->inlays}}">{{$editGuitar->neckInlays->type}} - Selected</option>
                                    @foreach ($inlays as $inlay)
                                        <option value="{{$inlay->id}}">{{$inlay->type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- custom inlay yes/no radio button --}}
                            
                            <div>
                                <p>Do you want <b><u>custom inlay</u></b> on 12th fret?</p>
                                    <div class="mb-3">
                                        <input class="form-check-input" type="radio" name="customInlayChoice" id="customInlayChoiceYes" value="Yes" onclick="getViableCustomInlays('Yes')" <?php if ($editGuitar->custom_inlay_option!=0) echo 'checked'; ?>>
                                        <label class="form-check-label" for="customInlayChoiceYes">
                                            Yes (See custom inlays for selected model)
                                        </label><br>
                                        <input class="form-check-input" type="radio" name="customInlayChoice" id="customInlayChoiceNo" value="No" onclick="removeCustomInlaySelector()" <?php if($editGuitar->custom_inlay_option==0) echo 'checked' ?> >
                                        <label class="form-check-label" for="customInlayChoiceNo">
                                            No (Standard inlay on 12th fret)
                                        </label>

                                    </div>
                                    @if($editGuitar->custom_inlay_option!=0)                                                                     
                                    @endif
                                  <div class="custom-inlay-field" id="custom-inlay-field">
                                    <input type='hidden' name='custominlay' id='custominlay' value='{{$editGuitar->custom_inlay_option}}'>
                                  </div>
                            </div>

                            {{-- end custom radio button --}}

                            <hr>
                            <p class="mx-auto" for="">Select <b>Finishes</b></p>

                            {{-- Select body finish --}}
                             <div class="mb-3">
                                <label for="bodyfinish" class="form-label">Select <b>Body Finish</b></label>
                                <select class="form-select form-select-lg" name="bodyfinish" id="bodyfinish">
                                    <option value="{{$editGuitar->body_finish}}">{{$editGuitar->bodyFinish->type}} - Selected</option>
                                    @foreach ($finishes as $finish)
                                        <option value="{{$finish->id}}">{{$finish->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                             {{-- Select top finish --}}
                             <div class="mb-3">
                                <label for="topfinish" class="form-label">Select <b>Top Finish</b> (must have top wood)</label>
                                <select class="form-select form-select-lg" name="topfinish" id="topfinish">
                                    <option value="{{$editGuitar->top_finish}}">{{$editGuitar->topFinish->type}} - Selected</option>
                                    @foreach ($finishes as $finish)
                                        <option value="{{$finish->id}}">{{$finish->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select neck finish --}}
                            <div class="mb-3">
                                <label for="neckfinish" class="form-label">Select <b>Neck Finish</b></label>
                                <select class="form-select form-select-lg" name="neckfinish" id="neckfinish">
                                    <option value="{{$editGuitar->neck_finish}}">{{$editGuitar->neckFinish->type}} - Selected</option>
                                    @foreach ($finishes as $finish)
                                        <option value="{{$finish->id}}">{{$finish->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            <div class="mt-3">
                                <div class="color-div">
                                    @if ($editGuitar->natural_finish!=0)
                                    <div id="selected-color">
                                        <p class="mb-3">Natural Finish - Selected</p>                                        
                                    </div>
                                    @elseif ($editGuitar->standard_color!=0)
                                        <p class="mb-3"><b>Selected Color</b> : {{$editGuitar->standardColor->type}}</p>
                                    @else
                                        <p class="mb-3"><b>Selected Color</b> : {{$editGuitar->transColor->type}}</p>                                        
                                    @endif
                                </div>

                                <label class="mb-3" for="">Select <b>new Color Type</b></label>                                
                                
                                <br>
                                <input class="form-check-input" type="radio" name="selectGuitarColor" id="selectNaturalFinish" value="" onchange="setNaturaFinish()">
                                <label class="form-check-label" for="selectNaturalFinish">
                                    Clear Natural Finish
                                </label>
                                <input class="form-check-input" type="radio" name="selectGuitarColor" id="selectstandard" value="" onchange="getStandardColors()">
                                <label class="form-check-label" for="selectstandard">
                                    Standard/Solid Color
                                </label>
                                <input class="form-check-input" type="radio" name="selectGuitarColor" id="selecttranslucent" value="" onchange="getTranslucentColors()">
                                <label class="form-check-label" for="selecttranslucent">
                                    Translucent Colors
                                </label>                                
                            </div>
                            <div class="my-3" id="color-selector-div">
                                <input type="hidden" name="standardcolor" value="{{$editGuitar->standard_color}}">
                                <input type="hidden" name="naturalfinish" value="{{$editGuitar->natural_finish}}">
                                <input type="hidden" name="translucentcolor" value="{{$editGuitar->translucent_color}}">
                            </div>

                            <hr>
                            
                            {{-- Select scale length --}}

                            <div class="mb-3">
                                <label for="scalelength" class="form-label">Select <b>Scale Length</b></label>
                                <select class="form-select form-select-lg" name="scalelength" id="scalelength">
                                    <option value="{{$editGuitar->scale_length}}">{{$editGuitar->scaleLength->type}} - Selected</option>
                                    @foreach ($scale_lengths as $scale_length)
                                        <option value="{{$scale_length->id}}">{{$scale_length->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select fret radius --}}
                            
                            <div class="mb-3">
                                <label for="fretradius" class="form-label">Select <b>Fret Radius</b></label>
                                <select class="form-select form-select-lg" name="fretradius" id="fretradius">
                                    <option value="{{$editGuitar->fret_radius}}">{{$editGuitar->fretRadius->type}} - Selected</option>
                                    @foreach ($fretboard_radii as $fretboard_radius)
                                        <option value="{{$fretboard_radius->id}}">{{$fretboard_radius->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select bridge --}}
                            
                            <div class="mb-3">
                                <label for="bridge" class="form-label">Select <b>Bridge</b></label>
                                <select class="form-select form-select-lg" name="bridge" id="bridge">
                                    <option value="{{$editGuitar->bridge}}">{{$editGuitar->guitarBridge->bridgeBrand->name." ".$editGuitar->guitarBridge->bridgeType->type." ".$editGuitar->guitarBridge->strings." strings"}}</option>
                                    @foreach ($bridges as $bridge)
                                        <option value="{{$bridge->id}}">{{$bridge->bridgeBrand->name." ".$bridge->bridgeType->type." ".$bridge->strings." string"}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select pickups config and pickups --}}
                            <div class="mb-3">
                                <div class="selected-pickup-config">
                                    <div class="mb-3">
                                        Selected <b>Pickup Configuration</b>: {{$editGuitar->pickupconfiguration->type}}
                                    </div>
                                    <div class="mb-3">
                                        
                                        <b>Neck Pickup</b>: 
                                        @if($editGuitar->neck_pickup!=0)
                                            {{$editGuitar->neckPickup->name}}
                                        @else
                                            <b>N/A</b>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <b>Middle Pickup</b>:
                                        @if($editGuitar->middle_pickup!=0)
                                         {{$editGuitar->middlePickup->name}}
                                        @else
                                            <b>N/A</b>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <b>Bridge Pickup</b>: 
                                        @if($editGuitar->bridge_pickup!=0)
                                        {{$editGuitar->bridgePickup->name}}
                                        @else
                                        <b>N/A</b>
                                        @endif
                                    </div>
                                </div>
                                <label for="neck" class="form-label">Edit <b>Pickup Configuration</b> Below</label>
                                {{-- radio buttons  --}}
                                <div class="row">
                                    <div class="my-3 col-md-3">
                                        <div class="mb-3">  
                                            <ul style="list-style-type:none;"> 
                                            @foreach ($pickup_configurations as $pickup_configuration)
                                                <li style="margin-bottom: 3px;">
                                                    <input class="form-check-input" type="radio" name="pickupconfiguration" id="{{str_replace(['-',"_"," "],'',$pickup_configuration->type)}}" onclick="{{'get'.str_replace(['-','_',' '],'',$pickup_configuration->type).'()'}}" value="{{$pickup_configuration->id}}" 
                                                    <?php if($pickup_configuration->id == $editGuitar->pickup_configuration) echo 'checked' ?> >
                                                    <label class="form-check-label" for="{{str_replace(['-',"_"," "],'',$pickup_configuration->type)}}">
                                                    {{$pickup_configuration->type}}
                                                    </label>    
                                                </li>
                                            @endforeach
                                        </ul>                                
                                        </div>                   
                                    </div>
                                    <div class="my-3 col-md-9 mr-auto"  id="pickup-configuration">   
                                        {{-- options from DB appear here --}}
                                        {{-- the following are pre-selected options --}}
                                        <input type="hidden" name="neckpickup" value="{{$editGuitar->neck_pickup}}">
                                        <input type="hidden" name="bridgepickup" value="{{$editGuitar->bridge_pickup}}">
                                        <input type="hidden" name="middlepickup" value="{{$editGuitar->middle_pickup}}">
                                    </div>
                                </div>
                            </div>
                            
                            
                            {{-- Select electronics --}}
                            
                            <div class="mb-3">
                                <label for="electronics" class="form-label">Select <b>Electronics</b></label>
                                <select class="form-select form-select-lg" name="electronics" id="electronics">
                                    <option value="{{$editGuitar->electronics}}">{{$editGuitar->guitarElectronics->type}}</option>
                                    @foreach ($electronics as $electronic)
                                        <option value="{{$electronic->id}}">{{$electronic->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                            {{-- Select pickup selectors --}}
                            
                            <div class="mb-3">
                                <label for="pickupselector" class="form-label">Select <b>Pickup Selector/Switch</b></label>
                                <select class="form-select form-select-lg" name="pickupselector" id="pickupselector">
                                    <option value="{{$editGuitar->pickup_selector}}">{{$editGuitar->pickupSelector->type}} - Selected</option>
                                    @foreach ($pickup_selectors as $pickup_selector)
                                        <option value="{{$pickup_selector->id}}">{{$pickup_selector->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                                                        
                            {{-- Select nut --}}
                            
                            <div class="mb-3">
                                <label for="nut" class="form-label">Select <b>Nut Type</b></label>
                                <select class="form-select form-select-lg" name="nut" id="nut">
                                    <option value="{{$editGuitar->nut}}">{{$editGuitar->guitarNut->type}} - Selected</option>
                                    @foreach ($nuts as $nut)
                                        <option value="{{$nut->id}}">{{$nut->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- only for admin* , add images for guitar --}}
                            
                            <div class="mb-3">
                            <label for="images" class="form-label">Add More Guitar <b>Images<b></label>    
                            <input class="form-control" type="file" name="images[]" id="images" multiple>
                            
                            </div>
                            <br>
                            <button class="btn btn-lg btn-success">Update Guitar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @php
        // for neck
        // selected woods
        $selected_woods=explode(" &mdash; ",$editGuitar->neckWoods->neck_woods);

        // woods array and associative arrays
        $woods_array_php=array();
        $wood_ids=array();
        $i=0;
        foreach ($neck_woods as $neckwood) {
            $woods_array_php[$i]=$neckwood->type;
            $wood_ids[$i]=$neckwood->id;
            $i++;
                    
        }
        

        $all_custom_inlays=array();
        $custom_inlay_names=array();
        // ^ has same keys as all_custom_inlay array, and is therefore accessible at same index/with same keys
        foreach ($custom_inlays as $custom_inlay) {
            $all_custom_inlays[$custom_inlay->id]=$custom_inlay->guitarModel->type;
            $custom_inlay_names[$custom_inlay->id]=$custom_inlay->type;
        }
    @endphp


<script>
    //get frets for all models
    var shapeFretsArray={!! json_encode($shape_frets_array,JSON_HEX_TAG) !!};
    var shapeFretsArrayIds=Object.keys(shapeFretsArray);
    var i;

    //get all custom inlays in array
    // $all_custom_inlays[PK id]="Name of model selected"
    var allCustomInlays={!! json_encode($all_custom_inlays,JSON_HEX_TAG) !!};
    var customInlayNames={!! json_encode($custom_inlay_names,JSON_HEX_TAG) !!};
    var customInlayIds=Object.keys(allCustomInlays);//Get all keys of associative array
    var modelName;
    var customInlaySelector;

    // yes no buttons
    yesButton = document.getElementById("customInlayChoiceYes");
    noButton = document.getElementById("customInlayChoiceNo")

    //get selected model value for edit form
    // e.g. if Sarus is selected, this value contains model name
    modelName=model.options[model.selectedIndex].text;


    // get selected model for when model changes in Edit form
    function getModelName(incoming){
        modelName=incoming.options[incoming.selectedIndex].text;
        // sets "modelname" as selected option name(i.e, text), not the "value" of option
    }

    // get all custom inlays for selected model

    function getViableCustomInlays(yesOrNo){
        var i;
        if(modelName==null){
            document.getElementById('custom-inlay-field').innerHTML='<p>Please select a model first!</p>'
        }
        if(yesOrNo=="Yes"){
            customInlaySelector='<select class="form-select form-select-lg" name="custominlay" id="custominlay">'
                for(i=0;i<customInlayIds.length;i++){
                    if(modelName==allCustomInlays[customInlayIds[i]]){
                        customInlaySelector += '<option value="'+ customInlayIds[i] +'">'+ customInlayNames[customInlayIds[i]]+'</option>';
                    }
                }
            customInlaySelector+='</select>';
            document.getElementById('custom-inlay-field').innerHTML=customInlaySelector;
        }

    }

    // for edit guitar
    var selectedCustomInlay=<?php echo $editGuitar->custom_inlay_option;?>
    // function to load "Select" with previous custom inlay selected
    function getEditedCustomInlays(confirmation,modelName){    
    var selectedInlayId=<?php echo $editGuitar->custom_inlay_option; ?> ;
    var i;
    if(modelName==null){
        document.getElementById('custom-inlay-field').innerHTML='<p>Please select a model first!</p>'
    }
    if(confirmation=="Yes"){
        customInlaySelector='<select class="form-select form-select-lg" name="custominlay" id="custominlay"><option value="'+selectedInlayId+'">'+selectedInlayName+' - Currently Selected</option>';
            for(i=0;i<customInlayIds.length;i++){
                if(modelName==allCustomInlays[customInlayIds[i]]){
                    customInlaySelector += '<option value="'+ customInlayIds[i] +'">'+ customInlayNames[customInlayIds[i]]+'</option>';
                }
            }
        customInlaySelector+='</select>';
        document.getElementById('custom-inlay-field').innerHTML=customInlaySelector;
        }  
    }
    var selectedInlayName=""
    if(selectedCustomInlay!=0){
        var selectedInlayName="<?php if($editGuitar->custom_inlay_option!=0) echo $editGuitar->customInlayOption->type; else echo '0';?>";
        getEditedCustomInlays("Yes",modelName);
    }

    function getNumberOfFrets(incoming){
        modelId=incoming.options[incoming.selectedIndex].value;
         for(i=0;i<shapeFretsArrayIds.length;i++){
            if(shapeFretsArrayIds[i]==modelId){
                document.getElementById("frets").value=shapeFretsArray[shapeFretsArrayIds[i]];
            }
        }
    }
    

    // remove the custom inlay selector when model changes

    function removeCustomInlaySelector(){
            noButton = document.getElementById("customInlayChoiceNo");
            hiddenCustomInlayField="<input type='hidden' name='custominlay' id='custominlay' value='0'>"
            document.getElementById('custom-inlay-field').innerHTML=hiddenCustomInlayField;
            yesButton.checked=false;
            noButton.checked=true;
    }

    //get all arrays of neck options by neck piece
    var onePieceNecks={!! json_encode($one_piece_neck_array,JSON_HEX_TAG) !!}
    var threePieceNecks={!! json_encode($three_piece_neck_array,JSON_HEX_TAG) !!}
    var fivePieceNecks={!! json_encode($five_piece_neck_array,JSON_HEX_TAG) !!}




    //if (i=0 to totalNeckOption) number matches id of one piece, show that to user/admin

    onePieceNecksIds=Object.keys(onePieceNecks);//has all ids of 1 piece necks from DB
    threePieceNecksIds=Object.keys(threePieceNecks);//has all ids of 3 piece necks from DB
    fivePieceNecksIds=Object.keys(fivePieceNecks);//has all ids of 5 piece necks from DB


    //empty selector variable for "select"
    var selector;

    function getAllOnePieceNecks(){
        selector='<select class="form-select form-select-lg" name="neckwooods" id="neck">'
        for(i=0;i<onePieceNecksIds.length;i++){
            selector += '<option value="'+ onePieceNecksIds[i] +'">'+onePieceNecks[onePieceNecksIds[i]]+'</option>';
            }
        selector += "</select>"
        document.getElementById('neck-select-div').innerHTML=selector;
    }

    function getAllThreePieceNecks(){
        selector='<select class="form-select form-select-lg" name="neckwoods" id="neck">'
        for(i=0;i<threePieceNecksIds.length;i++){
            selector += '<option value="'+ threePieceNecksIds[i] +'">'+threePieceNecks[threePieceNecksIds[i]]+'</option>';
            }
        selector += "</select>"
        document.getElementById('neck-select-div').innerHTML=selector;

    }

        function getAllFivePieceNecks(){
        selector='<select class="form-select form-select-lg" name="neckwoods" id="neck">'
        for(i=0;i<fivePieceNecksIds.length;i++){
            selector += '<option value="'+ fivePieceNecksIds[i] +'">'+fivePieceNecks[fivePieceNecksIds[i]]+'</option>';
            }
        selector += "</select>"
        document.getElementById('neck-select-div').innerHTML=selector;
    }

    //pickup selection
    //all functions
    var bridgeHumbuckers={!! json_encode($bridgeHumbuckers,JSON_HEX_TAG) !!};
    var bridgeHumbuckersIds=Object.keys(bridgeHumbuckers);//has id of associative bridgeHumbuckers array

    var neckHumbuckers={!! json_encode($neckHumbuckers,JSON_HEX_TAG) !!};  
    var neckHumbuckersIds=Object.keys(neckHumbuckers);//has id of associative neckHumbuckers array
    
    var bridgeSingleCoils={!! json_encode($bridgeSingleCoils,JSON_HEX_TAG) !!};
    var bridgeSingleCoilsIds=Object.keys(bridgeSingleCoils);
    
    var middleSingleCoils={!! json_encode($middleSingleCoils,JSON_HEX_TAG) !!};
    var middleSingleCoilsIds=Object.keys(middleSingleCoils);
    
    var neckSingleCoils={!! json_encode($neckSingleCoils,JSON_HEX_TAG) !!};;
    var neckSingleCoilsIds=Object.keys(neckSingleCoils);

    var j;

    function getBridgeHumbuckers(){
        selector='<select class="form-select form-select-lg" name="bridgepickup" id="bridgepickup">';
        
        for(j=0;j<bridgeHumbuckersIds.length;j++){
            selector += '<option value="'+ bridgeHumbuckersIds[j] +'">'+bridgeHumbuckers[bridgeHumbuckersIds[j]]+'</option>';
        }
        selector+="</select>";
        return selector;
    }

    function getNeckHumbuckers(){
        selector='<select class="form-select form-select-lg" name="neckpickup" id="neckpickup">';
        
        for(j=0;j<neckHumbuckersIds.length;j++){
            selector += '<option value="'+ neckHumbuckersIds[j] +'">'+neckHumbuckers[neckHumbuckersIds[j]]+'</option>';
        }
        selector+="</select>";
        return selector;
    }

    function getNeckSingleCoils(){
        selector='<select class="form-select form-select-lg" name="neckpickup" id="neckpickup">';
        
        for(j=0;j<neckSingleCoilsIds.length;j++){
            selector += '<option value="'+ neckSingleCoilsIds[j] +'">'+neckSingleCoils[neckSingleCoilsIds[j]]+'</option>';
        }
        selector+="</select>";
        return selector;
    }

    function getMiddleSingleCoils(){
        selector='<select class="form-select form-select-lg" name="middlepickup" id="middlepickup">';
        
        for(j=0;j<middleSingleCoilsIds.length;j++){
            selector += '<option value="'+ middleSingleCoilsIds[j] +'">'+middleSingleCoils[middleSingleCoilsIds[j]]+'</option>';
        }
        selector+="</select>";
        return selector;
    }

    function getBridgeSingleCoils(){
        selector='<select class="form-select form-select-lg" name="bridgepickup" id="bridgepickup">';
        
        for(j=0;j<bridgeSingleCoilsIds.length;j++){
            selector += '<option value="'+ bridgeSingleCoilsIds[j] +'">'+bridgeSingleCoils[bridgeSingleCoilsIds[j]]+'</option>';
        }
        selector+="</select>";
        return selector;
 
    }


    // get configuration functions
    var configuation;
    function getHSS(){
        configuration='<div class="mb-3"> <p>Select Bridge Humbucker</p>'+ getBridgeHumbuckers() +'</div>'+'<div class="mb-3"> <p>Select Middle Single Coil</p>'+getMiddleSingleCoils() +'</div>'+'<div class="mb-3"> <p>Select Neck Single Coil</p>'+ getNeckSingleCoils() +'</div>';
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    function getHS(){
        configuration='<div class="mb-3"> <p>Select Bridge Humbucker</p>'+ getBridgeHumbuckers() +'</div>'+' <input type="hidden" name="middlepickup" value="0" > '+'<div class="mb-3"> <p>Select Neck Single Coil</p>'+ getNeckSingleCoils() +'</div>';
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    function getHSH(){
        configuration='<div class="mb-3"> <p>Select Bridge Humbucker</p>'+ getBridgeHumbuckers() +'</div>'+'<div class="mb-3"> <p>Select Middle Single Coil</p>'+getMiddleSingleCoils() +'</div>'+'<div class="mb-3"> <p>Select Neck Humbucker</p>'+ getNeckHumbuckers() +'</div>';
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    function getHH(){
        configuration='<div class="mb-3"> <p>Select Bridge Humbucker</p>'+ getBridgeHumbuckers() +'</div>'+' <input type="hidden" name="middlepickup" value="0" > '+'<div class="mb-3"> <p>Select Neck Humbucker</p>'+ getNeckHumbuckers() +'</div>';
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    function getSSS(){
        configuration='<div class="mb-3"> <p>Select Bridge Single Coil</p>'+ getBridgeSingleCoils() +'</div>'+'<div class="mb-3"> <p>Select Middle Single Coil</p>'+ getMiddleSingleCoils() +'</div>'+'<div class="mb-3"> <p>Select Neck Single Coil</p>'+ getNeckSingleCoils() +'</div>';
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    function getH(){    //only bridge humbucker
        configuration='<div class="mb-3"> <p>Select Bridge Humbucker</p>'+ getBridgeHumbuckers() +'</div> <input type="hidden" name="middlepickup" value="0" ><input type="hidden" name="neckpickup" value="0" > ' ;
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    function getSS(){    //only two single coils
        configuration='<div class="mb-3"> <p>Select Bridge Single Coil</p>'+ getBridgeSingleCoils() +'</div>' + ' <input type="hidden" name="middlepickup" value="0" > ' + '<div class="mb-3"> <p>Select Neck Single Coil</p>'+ getNeckSingleCoils() +'</div>';
        document.getElementById("pickup-configuration").innerHTML=configuration;
        document.getElementById("pickup-configuration").setAttribute('style','border: 1px solid #ced4da;padding:20px;border-radius:10px;');
    }

    //colors and color selection
    var standardColorArray = {!! json_encode($standard_color_array,JSON_HEX_TAG) !!};
    var translucentColorArray={!! json_encode($translucent_color_array,JSON_HEX_TAG) !!};
    var standardColorArrayIds=Object.keys(standardColorArray);
    var translucentColorArrayIds=Object.keys(translucentColorArray);
    var colorSelector;
    function getStandardColors(){
        colorSelector='<b><label for="standardcolor" class="mb-3">Selected solid color (edit below)</label></b><select class="form-select form-select-lg" name="standardcolor" id="standardcolor">';
        for(i=0;i<standardColorArrayIds.length;i++){
            colorSelector+='<option value='+ standardColorArrayIds[i] +'>'+ standardColorArray[standardColorArrayIds[i]] +'</option>';
        }
        colorSelector+='</select><input type="hidden" name="translucentcolor" id="translucentcolor" value="0"><input type="hidden" name="naturalfinish" value="0">';
        document.getElementById('color-selector-div').innerHTML=colorSelector;    
    }

    function getTranslucentColors(){
        colorSelector='<b><label for="translucentcolor" class="mb-3">Selected translucent color/finish (edit below)</label><b><br><select class="form-select form-select-lg" name="translucentcolor" id="translucentcolor">';
        for(i=0;i<translucentColorArrayIds.length;i++){
            colorSelector+='<option value='+ translucentColorArrayIds[i] +'>'+ translucentColorArray[translucentColorArrayIds[i]] +'</option>';
        }
        colorSelector+='</select><input type="hidden" name="standardcolor" id="standardcolor" value="0"><input type="hidden" name="naturalfinish" value="0">';
        document.getElementById('color-selector-div').innerHTML=colorSelector;
    }

    function setNaturaFinish(){
        colorSelector='<input type="hidden" name="translucentcolor" id="translucentcolor" value="0"><input type="hidden" name="standardcolor" id="standardcolor" value="0"><input type="hidden" name="naturalfinish" value="1">';
        document.getElementById('color-selector-div').innerHTML=colorSelector;
    }


    // create neck piece form

    function createNeckPieceForm(pieces){
        var neck_piece=pieces;
        var i=0;
        var j=0;
        var w=0;
        var woods={!! json_encode($woods_array_php,JSON_HEX_TAG) !!};
        var wood_ids={!! json_encode($wood_ids,JSON_HEX_TAG) !!};
        // var woods=json_encode($neck_woods);
        var selector_div='<h5 class="my-3">Select Neck Woods</h5>';
        for(i=0;i<neck_piece;i++){
            selector_div+="<div id='added_selector_"+(i+1)+"' class='added_selector'><select class='form-select mb-3' name='piece_"+ (i+1) +"'><option value=''>Select Piece "+ (i+1) +"</option>"
            for(j=0;j<woods.length;j++){
                selector_div +='<option value="' + woods[j] + '">' + woods[j] +'</option>';
            }
            selector_div +='</select></div>';
        }

        selector_div += '<input type="hidden" name="looper" value='+ pieces +'>'+'<button class="btn btn-success my-3">Update Neck Profile</button>';
        document.getElementById("wood-select-div").innerHTML=selector_div;

    }

</script>


</x-app-layout>
