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

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Guitars / Add Guitar Option') }}
        </h2>
    </x-slot>
    <x-guitar-options-bar/>

    
    @php
        $name=$info_array[1];
        $type=$info_array[0];
        if ($type!="custom inlay") {
            $guitar_models=array();
        }

    @endphp

    @if($type=="payment options" || $type=="order rules" || $type=="color" ||$type=="pickup configuration"||$type==="scale length"|| $type==="custom inlay" || $type==="neck type" || $type==="finish" || $type==="bridge color" || $type==="bridge scale" || $type==="nut" || $type==="radius" || $type==="electronics" || $type==="extras" || $type==="inlay" || $type=="shape" || $type=="defaults" ||$type=="pickup selector")
        
    <x-four-column-edit-table :edit="$edit" :infoarray="$info_array" :guitarmodels="$guitar_models" />

    @elseif ($type=="wood" || $type == "body wood" || $type == "fretboard wood" || $type=="top wood" || $type=="neck wood")

    <x-wood-edit-table :edit="$edit" :infoarray="$info_array"/>   

    @elseif ($type=="frets")

    <x-branded-fret-edit-table :infoarray="$info_array" :edit="$edit" :brands="$brands"/>

    @elseif($type=="tuners")

    <x-branded-tuners-edit-table :infoarray="$info_array" :edit="$edit" :brands="$brands" />

    @elseif ($type=="bridge")

    <x-branded-product-edit-table :infoarray="$info_array" :edit="$edit" :brands="$brands"/>

    @elseif ($type=="bridge brand" || $type=="frets brand" || $type=="tuners brand")

    <x-brand-edit-table :edit="$edit" :infoarray="$info_array" />
    
    @elseif ($type=="neck")
        
        <x-neck-edit :edit="$edit" :infoarray="$info_array" :neckwoods="$neck_woods"/>

    @elseif($type="gallery image")
    
        <x-gallery-image-edit /> 

    @endif
</x-app-layout>