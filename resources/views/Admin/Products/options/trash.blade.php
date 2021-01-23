<style>
    html {
        scroll-behavior: smooth;
    }

    .type_column {
        width:16%;
    }

    .description_column {
        width: 70%;
    }

    .action_column{
        
    }



</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trash Can') }}
        </h2>
    </x-slot>
    
    <x-pickup-options-bar />
    <div class="row">
        @if(session('success'))
        <div class="alert alert-warning alert-dismissible fade show w-100" role="alert" style="text-align: center;">
        <strong>{{session('success')}}</strong>
        <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
        @endif
    </div>
        <div class="container mt-5" id="#trash_tables">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">All Trashed Posts</h5>
                    <div class="card-body">
                        <x-trash-table :trashes="$trashed_pickups" id="pickups" category="pickup" title="Pickups"/>
                        <x-trash-table :trashes="$trashed_types" id="pickup_types" category="type" title="Pickup Types"/>
                        <x-trash-table :trashes="$trashed_brands" id="brand" category="brand" title="Pickup Brands"/>
                        <x-trash-table :trashes="$trashed_positions" id="pickup_positions" category="position" title="Pickup Position"/>
                        <x-trash-table :trashes="$trashed_coverings" id="pickup_coverings" category="covering" title="Pickup Coverings"/>
                        <x-trash-table :trashes="$trashed_magnets" id="pickup_magnets" category="pickupmagnet" title="Pickup  Magnet Materials"/>
                        <x-trash-table :trashes="$trashed_actives" id="active_passive" category="activepassive" title="Active or Passive Pickup Type"/>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
