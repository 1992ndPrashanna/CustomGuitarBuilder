<x-app-layout>
    {{-- 
        'brands','types','positions','activepassive','coverings','magnets'    
    --}}
    <style>

    
        table {
            background-color:#fff;
        }

        .btn-outline-success:hover {
            background-color:rgb(126, 241, 126);
        }

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Guitars / '). $info_array[2] }}
        </h2>
    </x-slot>
    <x-guitar-options-bar/>
    @php
        $type=$info_array[1];

        if($type!="custom inlay"){
            $guitar_models=array();
        }
    @endphp

        @if($type=="bridge" || $type=="frets" || $type=="tuners")
        {{-- bridge, frets, tuners page --}}
        <x-branded-product-table :infoarray="$info_array" :alldata="$all_data" :brands="$brands" />

        @elseif ($type=="gallery image")

        <x-gallery-image :imageUrls="$all_data"/>

        @elseif ($type=="wood")
        {{-- all woods page --}}
        <x-wood-table :infoarray="$info_array" :alldata="$all_data" />

        @elseif ($type=="body wood" || $type=="fretboard wood" || $type=="top wood" || $type=="neck wood")
        {{-- body wood page --}}
        <x-test-component :alldata="$all_data" :infoarray="$info_array" />

        {{--  brand page  --}}
        @elseif($type=="bridge brand" || $type=="frets brand" || $type=="tuners brand")
        <x-brand-table :infoarray="$info_array" :alldata="$all_data" />

        @elseif ($type=="neck")
        <x-neck :alldata="$all_data" :infoarray="$info_array" :neckwoods="$neck_woods"/>

        @elseif($type=="payment options" || $type=="order rules" | $type=="pickup configuration" || $type=="translucent color" || $type=="color" || $type=="radius" || $type=="scale length" || $type=="inlay" || $type=="custom inlay" || $type=="electronics" || $type=="pickup selector" || $type=="bridge color" ||  $type=="finish" || $type=="neck type" || $type=="extras" || $type=="nut" ||$type=="bridge color" ||$type=="bridge scale" || $type=="bridge type" ||$type=="inlay" ||$type=="shape" || $type=="defaults")
        <x-four-column-table :alldata="$all_data" :infoarray="$info_array" :guitarmodels="$guitar_models"/>
                
        @endif
    <script type="text/javascript" src="{{URL::asset('js/trix.js')}}"></script>


    {{-- @if ($type=="neck")
    @php
    $woods_array_php=array();
    $wood_ids=array();
        $i=0;
        foreach ($neck_woods as $neckwood) {
            $woods_array_php[$i]=$neckwood->type;
            $wood_ids[$i]=$neckwood->id;
            $i++;
        }

    @endphp
    <script>
        //one form method
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

            selector_div += '<input type="hidden" name="looper" value='+ pieces +'>'+'<button class="btn btn-success my-3">Create Neck Profile</button>';
            document.getElementById("wood-select-div").innerHTML=selector_div;

        }
        </script>
    @endif --}}
</x-app-layout>
