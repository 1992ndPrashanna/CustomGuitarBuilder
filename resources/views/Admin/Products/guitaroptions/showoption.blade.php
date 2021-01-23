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

    <div class="container-sm my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8">
                    {{-- view table component --}}
                </div>
                <div class="col-md-4">
                    {{-- add form --}}
                </div>                
            </div>
    </div>
    </div>
</x-app-layout>
