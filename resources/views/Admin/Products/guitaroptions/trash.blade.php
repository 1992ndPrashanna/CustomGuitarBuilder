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
    
</x-app-layout>
