<style>
    a:hover {
        box-shadow:0 1px #fff;
        
    }
</style>

<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
        @php
        $i=0;

    $attributes = [
        'All Pickups',
        'Pickup Brands',
        'Pickup Type',
        'Pickup Position',
        'Pickup Coverings',
        'Magnet Material',
        'Active Passive'
    ];    

    $url=[
        'products.pickups',
        'pickups.brands',
        'pickups.type',
        'pickups.position',
        'pickups.coverings',
        'pickups.magnets',
        'active.passive'
    ];
    @endphp

    {{-- <div class="container">
        {{-- url method--}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand">Pickup Options</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  @foreach ($attributes as $attribute)
                    <li class="nav-item mx-2 my-3" style="border:0px;">
                        <a class="nav-link" href="{{route($url[$i])}}">{{$attribute}} <span class="sr-only">(current)</span></a>
                        @php
                            $i++;
                        @endphp
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
        </nav>







