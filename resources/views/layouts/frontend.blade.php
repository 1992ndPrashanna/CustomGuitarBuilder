<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @yield('title')
        </title>

        <!-- Fonts -->
        {{-- kanit --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,900;1,800;1,900&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">

        <link rel="stylesheet"  href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400&display=swap" rel="stylesheet">
        {{-- Xanh Mono --}}
        
        <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Xanh+Mono&display=swap" rel="stylesheet">
        
        {{-- Styles --}}
        
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/trix.css')}}" >
        
        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/bootnavbar.css')}}" >
        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <link rel="stylesheet" type="text/css" href="{{URL::asset('css/frontend.css')}}">
        @livewireStyles
        {{-- foundation --}}


        {{-- style --}}
        <style>
            ul { 
            list-style-type: disc; 
            list-style-position: inside; 
            }
            ol { 
            list-style-type: decimal; 
            list-style-position: inside; 
            }
            ul ul, ol ul { 
            list-style-type: circle; 
            list-style-position: inside; 
            margin-left: 15px; 
            }
            ol ol, ul ol { 
            list-style-type: lower-latin; 
            list-style-position: inside; 
            margin-left: 15px; 
            }
            trix-toolbar .trix-button-group--file-tools {
                display: none;
                }

            
        </style>
    </head>
<body>
    <x-front-end-navigation-bar :pickups='$pickups' :pickupbrands="$pickup_brands" :models="$models"/>
    
    @yield('content')

    <script src="{{ mix('js/app.js') }}"></script>        
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/bootnavbar.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.vide.min.js') }}"></script>
    @if(Session('failure'))      
    <script>
    $(function() {
        $('#viewCustomOrder').modal('show');
    });
    </script>
    @endif
    @yield('scripts')
</body>
</html>