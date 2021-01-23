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
        <div class="col-md-10 mx-auto mt-5">
            <div class="row">   
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="card col-md-10 mx-auto mt-5">
            <div class="card-header">Create Guitar</div>
            <div class="card-body container-fluid col-md-8">
                <div class="mx-auto">
                    <div class="row">
                        <form action="{{route('guitar.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            {{-- Select model --}}
                            <div class="my-3">
                                <label for="model" class="form-label required">Select <b> Guitar Model</b></label>
                                <select class="form-select form-select-lg" name="model" id="model" onchange="getModelName(this);removeCustomInlaySelector();getNumberOfFrets(this)">
                                        <option value="">Click to view options</option>
                                    @foreach ($shapes as $shape)
                                        <option value="{{$shape->id}}">{{$shape->type}}</option>
                                    @endforeach                                
                                </select>     
                                <input type="hidden" id="frets" name="frets" value="">         
                            </div>

                            {{-- Select bodywood --}}
                            <div class="my-3">
                                <label for="bodywood" class="form-label required">Select <b>Body Wood</b></label>
                                <select class="form-select form-select-lg" name="bodywood" id="bodywood">
                                    <option value="">Click to view options</option>
                                    @foreach ($body_woods as $body_wood)
                                        <option value="{{$body_wood->id}}">{{$body_wood->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                             {{-- Select top wood --}}
                             <div class="my-3">
                                <label for="topwood" class="form-label">Select <b>Top Wood</b> (optional)</label>
                                <select class="form-select form-select-lg" name="topwood" id="topwood">
                                    <option value="">Click to view options</option>
                                    @foreach ($top_woods as $top_wood)
                                        <option value="{{$top_wood->id}}">{{$top_wood->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                            {{-- Select neck attachment --}}
                            <div class="mb-3">
                                <label for="neckattachment" class="form-label required">Select <b>Neck Attachment</b></label>
                                <select class="form-select form-select-lg" name="neckattachment" id="neckattachment">
                                    <option value="">Click to view options</option>
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
                                
                                    <input class="form-check-input" type="radio" name="piece" id="onepiece" value="1" onchange="getAllOnePieceNecks()">
                                    <label class="form-check-label" for="onepiece">
                                    1-piece
                                    </label>
                                
                                    <input class="form-check-input" type="radio" name="piece" id="threepiece" value="3" onchange="getAllThreePieceNecks()">
                                    <label class="form-check-label" for="threepiece">
                                    3-piece
                                    </label>
                                
                                    <input class="form-check-input" type="radio" name="piece" id="fivepiece" value="5" onchange="getAllFivePieceNecks()">
                                    <label class="form-check-label" for="fivepiece">
                                    5-piece
                                    </label>
                                    
                                    <div class="my-3" id="neck-select-div" class="mx-auto">
                                        
                                    </div>                                    
                                </div>
                            </div>

                             {{-- Select Fretboard Wood --}}
                             <div class="mb-3">
                                <label for="fretboardwood" class="form-label required">Select <b>Fretboard/Fingerboard Wood</b></label>
                                <select class="form-select form-select-lg" name="fretboardwood" id="fretboardwood">
                                    <option value="">Click to view options</option>
                                    @foreach ($fretboard_woods as $fretboard_wood)
                                        <option value="{{$fretboard_wood->id}}">{{$fretboard_wood->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                            {{-- Select Frets --}}
                            <div class="mb-3">
                                <label for="frettype" class="form-label required">Select <b>Fretwire Type</b></label>
                                <select class="form-select form-select-lg" name="frettype" id="frettype">
                                    <option value="">Click to view options</option>
                                    @foreach ($fret_types as $fret_type)
                                        <option value="{{$fret_type->id}}">{{$fret_type->fretBrand->name." ".$fret_type->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            <hr>
                            {{-- Select Inlays --}}
                            <div class="mb-3">
                                <label for="inlay" class="form-label required">Select <b>Inlay</b></label>
                                <select class="form-select form-select-lg" name="inlay" id="inlay">
                                    <option value="">Click to view inlays</option>
                                    @foreach ($inlays as $inlay)
                                        <option value="{{$inlay->id}}">{{$inlay->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- custom inlay yes/no radio button --}}
                            
                            <div>
                                <p>Do you want <b><u>custom inlay</u></b> on 12th fret?</p>
                                    <div class="mb-3">
                                        <input class="form-check-input" type="radio" name="customInlayChoice" id="customInlayChoiceYes" value="Yes" onclick="getViableCustomInlays('Yes')">
                                        <label class="form-check-label" for="customInlayChoiceYes">
                                            Yes (See custom inlays for selected model)
                                        </label><br>
                                        <input class="form-check-input" type="radio" name="customInlayChoice" id="customInlayChoiceNo" value="No" onclick="removeCustomInlaySelector()">
                                        <label class="form-check-label" for="customInlayChoiceNo">
                                            No (Standard inlay on 12th fret)
                                        </label>

                                    </div>
                                  <div class="custom-inlay-field" id="custom-inlay-field">
                                    <input type='hidden' name='custominlay' id='custominlay' value='0'>
                                  </div>
                            </div>

                            {{-- end custom radio button --}}

                            <hr>
                            <p class="mx-auto" for="">Select <b>Finishes</b></p>

                            {{-- Select body finish --}}
                             <div class="mb-3">
                                <label for="bodyfinish" class="form-label required">Select <b>Body Finish</b></label>
                                <select class="form-select form-select-lg" name="bodyfinish" id="bodyfinish">
                                    <option value="">Click to view finishes</option>
                                    @foreach ($finishes as $finish)
                                        <option value="{{$finish->id}}">{{$finish->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                             {{-- Select top finish --}}
                             <div class="mb-3">
                                <label for="topfinish" class="form-label required">Select <b>Top Finish</b> (must have top wood)</label>
                                <select class="form-select form-select-lg" name="topfinish" id="topfinish">
                                    <option value="">Click to view finishes</option>
                                    @foreach ($finishes as $finish)
                                        <option value="{{$finish->id}}">{{$finish->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select neck finish --}}
                            <div class="mb-3">
                                <label for="neckfinish" class="form-label required">Select <b>Neck Finish</b></label>
                                <select class="form-select form-select-lg" name="neckfinish" id="neckfinish">
                                    <option value="">Click to view finishes</option>
                                    @foreach ($finishes as $finish)
                                        <option value="{{$finish->id}}">{{$finish->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            <div class="mt-3">
                                <label class="mb-3" for="">Select <b>Color Type</b></label>
                                <br>
                                <input class="form-check-input" type="radio" name="selectGuitarColor" id="selectNaturalFinish" value="1" onchange="setNaturaFinish()">
                                <label class="form-check-label" for="selectNaturalFinish">
                                    Clear Natural Finish
                                </label>
                                <input class="form-check-input" type="radio" name="selectGuitarColor" id="selectstandard" value="1" onchange="getStandardColors()">
                                <label class="form-check-label" for="selectstandard">
                                    Standard/Solid Color
                                </label>
                                <input class="form-check-input" type="radio" name="selectGuitarColor" id="selecttranslucent" value="1" onchange="getTranslucentColors()">
                                <label class="form-check-label" for="selecttranslucent">
                                    Translucent Colors
                                </label>                                
                            </div>
                            <div class="my-3" id="color-selector-div">

                            </div>

                            <hr>
                            
                            {{-- Select scale length --}}

                            <div class="mb-3">
                                <label for="scalelength" class="form-label required">Select <b>Scale Length</b></label>
                                <select class="form-select form-select-lg" name="scalelength" id="scalelength">
                                    <option value="">Click to view scale lengths</option>
                                    @foreach ($scale_lengths as $scale_length)
                                        <option value="{{$scale_length->id}}">{{$scale_length->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select fret radius --}}
                            
                            <div class="mb-3">
                                <label for="fretradius" class="form-label required">Select <b>Fret Radius</b></label>
                                <select class="form-select form-select-lg" name="fretradius" id="fretradius">
                                    <option value="">Click to select fret radius</option>
                                    @foreach ($fretboard_radii as $fretboard_radius)
                                        <option value="{{$fretboard_radius->id}}">{{$fretboard_radius->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select bridge --}}
                            
                            <div class="mb-3">
                                <label for="bridge" class="form-label required">Select <b>Bridge</b></label>
                                <select class="form-select form-select-lg" name="bridge" id="bridge">
                                    <option value="">Click to view bridge options</option>
                                    @foreach ($bridges as $bridge)
                                        <option value="{{$bridge->id}}">{{$bridge->bridgeBrand->name." ".$bridge->bridgeType->type." ".$bridge->strings." string"}}</option>
                                    @endforeach
                                </select>                                
                            </div>

                            {{-- Select pickups config and pickups --}}
                            <div class="mb-3">
                                <label for="" class="form-label required">Select <b>Pickup Configuration</b></label>
                                {{-- radio buttons  --}}
                                <div class="row">
                                    <div class="my-3 col-md-3">
                                        <div class="mb-3">  
                                            <ul style="list-style-type:none;"> 
                                            @foreach ($pickup_configurations as $pickup_configuration)
                                                <li style="margin-bottom: 3px;">
                                                    <input class="form-check-input" type="radio" name="pickupconfiguration" id="{{str_replace(['-',"_"," "],'',$pickup_configuration->type)}}" onchange="{{'get'.str_replace(['-','_',' '],'',$pickup_configuration->type).'()'}}" value="{{$pickup_configuration->id}}">
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
                                    </div>
                                </div>
                            </div>
                            
                            
                            {{-- Select electronics --}}
                            
                            <div class="mb-3">
                                <label for="electronics" class="form-label required">Select <b>Electronics</b></label>
                                <select class="form-select form-select-lg" name="electronics" id="electronics">
                                    <option value="">Click to view electronics options</option>
                                    @foreach ($electronics as $electronic)
                                        <option value="{{$electronic->id}}">{{$electronic->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                            {{-- Select pickup selectors --}}
                            
                            <div class="mb-3">
                                <label for="pickupselector" class="form-label required">Select <b>Pickup Selector/Switch</b></label>
                                <select class="form-select form-select-lg" name="pickupselector" id="pickupselector">
                                    <option value="">Click to view pickup switches</option>
                                    @foreach ($pickup_selectors as $pickup_selector)
                                        <option value="{{$pickup_selector->id}}">{{$pickup_selector->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                                                        
                            {{-- Select nut --}}
                            
                            <div class="mb-3">
                                <label for="nut" class="form-label required">Select <b>Nut Type</b></label>
                                <select class="form-select form-select-lg" name="nut" id="nut">
                                    <option value="">Click to view nut types</option>
                                    @foreach ($nuts as $nut)
                                        <option value="{{$nut->id}}">{{$nut->type}}</option>
                                    @endforeach
                                </select>                                
                            </div>
                            
                            {{-- extras --}}

                            <p>Extras included with all guitars </p>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <ul>
                                    @foreach ($extras as $extra)
                                        
                                            <li>
                                               <strong> {{$extra->type}} </strong>
                                               @if ($extra->description!="")
                                               {{": ".$extra->description}}
                                               @endif
                                               
                                            </li>
                                        
                                    @endforeach
                                </ul>
                            </div>

                            {{-- only for admin* , add images for guitar --}}
                            
                            <div class="mb-3">
                            <label for="images" class="form-label">Upload Guitar <b>Images<b></label>    
                            <input class="form-control" type="file" name="images[]" id="images" multiple>
                            
                            </div>
                            <br>
                            <button class="btn btn-lg btn-success">Create Guitar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @php
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

    // get selected model
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
        colorSelector='<b><label for="standardcolor" class="mb-3">Select a solid color</label></b><select class="form-select form-select-lg" name="standardcolor" id="standardcolor">';
        for(i=0;i<standardColorArrayIds.length;i++){
            colorSelector+='<option value='+ standardColorArrayIds[i] +'>'+ standardColorArray[standardColorArrayIds[i]] +'</option>';
        }
        colorSelector+='</select><input type="hidden" name="translucentcolor" id="translucentcolor" value="0"><input type="hidden" name="naturalfinish" value="0">';
        document.getElementById('color-selector-div').innerHTML=colorSelector;
    }

    function getTranslucentColors(){
        colorSelector='<b><label for="translucentcolor" class="mb-3">Select a translucent color/finish</label><b><br><select class="form-select form-select-lg" name="translucentcolor" id="translucentcolor">';
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
</script>


</x-app-layout>

                            {{-- <div class="mb-3">
                                <label for="custominlay" class="form-label">Select Custom Inlay (Optional)</label>
                                <select class="form-select form-select-lg" name="custominlay" id="custominlay">
                                    <option value="">Click to view custom inlays</option>
                                    @foreach ($custom as $inlay)
                                        <option value="{{$inlay->id}}">{{$inlay->type}}</option>
                                    @endforeach
                                </select>                                
                            </div> --}}