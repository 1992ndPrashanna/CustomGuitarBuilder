<style>
    a:hover {
        box-shadow:1px 1px rgb(212, 212, 212);
        color:#000;
        
    }
</style>

<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
        @php
        $i=0;
        $attributes = [
            "Guitar Models",
            "All Woods",
            "Body Woods",	
            "Top Woods",
            "Neck Woods",
            "Fretboard Woods",
            "Bridge Brands",
            "Fret Brands",
            "Tuners Brands",	
            "Guitar Neck",
            "Neck Attachment Type",	
            "Frets",		
            "Radius",
            "Inlay",	
            "Custom Inlays",
            "Scale Length",	
            "Bridge",	
            "Bridge Scale",		
            "Bridge Color",	
            "Bridge Type",	
            "Finishes",
            "Standard Colors",
            "Translucent Colors",	
            "Electronics",	
            "Nut",	
            "Tuners",		
            "Extras",
            "Default Options",
            "Pickup Selectors",
            "Pickup Config",
            "Ordering Rules",
            "Custom Shop Gallery Images",
            "Payment Options"
            
    ];    
    $url=[
        "guitar.shape",
        "guitar.wood",
        "guitar.bodywood",
        "guitar.topwood",
        "guitar.neckwood",
        "guitar.fretboard",
        "guitar.bridgebrand",
        "guitar.fretsbrand",
        "guitar.tunersbrand",
        "guitar.neck",
        "guitar.necktype",
        "guitar.frets",
        "guitar.radius",
        "guitar.inlay",
        "guitar.custominlay",
        "guitar.scalelength",
        "guitar.bridge",
        "guitar.bridgescale",
        "guitar.bridgecolor",
        "guitar.bridgetype",
        "guitar.finish",
        "guitar.color",
        "guitar.transcolor",
        "guitar.electronics",
        "guitar.nut",
        "guitar.tuners",
        "guitar.extras",
        "guitar.defaults",
        "guitar.pickupselector",
        "guitar.pupconfig",
        "guitar.rules",
        "guitar.galleryimage",
        "guitar.paymentoptions"
    ];
    @endphp

    {{-- <div class="container">
        {{-- url method--}}

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 15px;">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                  
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item mx-2 my-3" style="border:0px;">  
                        <a href="{{url('/guitar/viewOrders')}}" class="nav-link">View Orders</a>
                    </li>

                    <li class="nav-item mx-2 my-3" style="border:0px;">  
                        <a href="{{url('/products/guitars/createform')}}" class="nav-link">Create Guitar</a>
                    </li>

                    <li class="nav-item mx-2 my-3" style="border:0px;">                        
                        <a class="nav-link" href="{{route('products.guitars')}}" ">View All Guitars<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mx-2 my-3" style="border:0px;">                        
                        <a class="nav-link" href="{{route($url[0])}}" ">{{$attributes[0]}} <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="guitarWoods" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Woods
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="guitarWoods">
                        @for ($i = 1; $i < 6; $i++)
                        <li>
                            <a class="dropdown-item" href="{{route($url[$i])}}">{{$attributes[$i]}}</a>
                        </li>
                        @endfor
                        </ul>
                    </li>
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="guitarWoods" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Brands
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="guitarWoods">
                        @for ($i = 6; $i < 9; $i++)
                        <li>
                            <a class="dropdown-item" href="{{route($url[$i])}}">{{$attributes[$i]}}</a>
                        </li>
                        @endfor
                        </ul>
                    </li>
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="guitarWoods" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Neck Options
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="guitarWoods">
                        @for ($i = 9; $i < 16; $i++)
                        <li>
                            <a class="dropdown-item" href="{{route($url[$i])}}">{{$attributes[$i]}}</a>
                        </li>
                        @endfor
                        </ul>
                    </li>
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="guitarWoods" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Bridge Options
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="guitarWoods">
                        @for ($i = 16; $i < 20; $i++)
                        <li>
                            <a class="dropdown-item" href="{{route($url[$i])}}">{{$attributes[$i]}}</a>
                        </li>
                        @endfor
                        </ul>
                    </li>
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="guitarWoods" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Finish and Color
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="guitarWoods">
                        @for ($i = 20; $i < 23; $i++)
                        <li>
                            <a class="dropdown-item" href="{{route($url[$i])}}">{{$attributes[$i]}}</a>
                        </li>
                        @endfor
                        </ul>
                    </li>
                    <li class="nav-item dropdown my-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="guitarWoods" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Other Options
                        </a>
                        <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="guitarWoods">
                        @for($i=23;$i<sizeof($attributes);$i++)
                            <li>
                                <a class="dropdown-item" href="{{route($url[$i])}}" ">{{$attributes[$i]}} <span class="sr-only">(current)</span></a>
                            </li>
                        @endfor
                        </ul>
                    </li>
                </ul>
              </div>
            </div>
          </nav>