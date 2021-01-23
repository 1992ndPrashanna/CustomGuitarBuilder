<style>
    .navbar-nav > li > .dropdown-menu > li > a:hover {
        background-image: none;
        text-decoration: underline;
        background-color: rgba(0, 0, 0);
        color:#fff; 
    }
    
    .navbar-nav > li > .dropdown-menu > li{
      color:#fff;
    }
    
    .navbar-nav > li > .dropdown-menu > li :hover{
      background-color: #000;
      text-decoration: none;
    }
    
    .dropdown-menu {
        background-color: rgb(0 0 0);
        color: #fff;
    }
    
    .dropdown-menu {
      background-color: rgba(255, 255, 255);
      color: #000;
    }
    .navbar-dark .navbar-nav .nav-link {
      color:#fff;
    }
    
    .navbar-dark .navbar-nav .nav-link:hover {
      text-decoration: underline;
    }
    
    .navbar-nav > li > .dropdown-menu { 
      background-color: #000; 
      padding: 5px; 
    }
    .navbar-nav > li > .dropdown-menu > li > a { 
      color: #fff;
    }

    .nav-link{
      margin-left: 30px;
    }
</style>
    
    @php
        // see what brand pickups are available
        $pickup_brand_array=array();
        $i=0;
        $j=0; //for checking brands
        $swap="";
        $total_number_of_pickup_brands=0;
      foreach ($pickupbrands as $pickup_brand) {
        $pickup_brand_array[$i]=$pickup_brand->brand;
        $i++;
        $total_number_of_pickup_brands++;
      }
    //Show Sahana Pickups on top
      if(!empty($pickup_brand_array)){
          if ($pickup_brand_array[0]!="Sahana") {
            $index=array_search('Sahana',$pickup_brand_array);
            $temp=$pickup_brand_array[0];
            $pickup_brand_array[0]="Sahana";
            $pickup_brand_array[$index]=$temp;
          }
        }
    @endphp
<div class="col-md-12">
  <div class="row">      
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top @php if($_SERVER['REQUEST_URI'] =='/' || $_SERVER['REQUEST_URI'] ==' ' ) echo 'bg-transparent';@endphp"  style=" background-color:#000; width: 100%;height:10%;">
      <div class="container-fluid" @php if($_SERVER['REQUEST_URI']!='/' ) echo 'style="background-color: #000;"'; @endphp ">
        <a class="navbar-brand" href="{{route("welcome")}}"><img src="{{asset("storage/frontend_images/SGWhiteLogo.png")}}" width="60px" alt=""></a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route("welcome")}}">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Guitars
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach($models as $model)            
                <li>
                  <a href="{{url('view/'.$model->type)}}" class="dropdown-item">{{$model->type}}</a>
                </li>
                @endforeach
              </ul>
            </li>
            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pickups
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @for ($i = 0; $i < $total_number_of_pickup_brands; $i++)
                <li class="" style="text-align:center;">{{$pickup_brand_array[$i]}}</li>
                  @foreach ($pickups as $pickup)
                  {{-- create url --}}
                      @php
                        $urlname=str_replace([' ','(','&',')','$'.'@','-','_','#','!'],'',$pickup->name);
                        $pickup_view_url='/view/'.$urlname.'/'.$pickup->id;
                      @endphp
                    @if ($pickup->pickupBrand->brand==$pickup_brand_array[$i])
                      <li><a class="dropdown-item" href="{{$pickup_view_url}}">{{$pickup->name}}</a></li>
                    @endif                  
                  @endforeach
                <li><hr class="dropdown-divider" style="color: #fff;"></li>
                @endfor
              </ul>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#about-us">About Us</a>
            </li>
            <li class="nav-item">
              <a href="{{route('guitar.build')}}" class="nav-link">Build Your Guitar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#viewCustomOrder">View Custom Order</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
    <!-- Show Custom Guitar Modal -->
<div class="modal fade" id="viewCustomOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#000;color:#fff;">
        <h4 class="modal-title" id="exampleModalLabel" >View Custom Order</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/customShop/viewGuitarOrder/')}}" method="GET">
          @csrf
          <div class="form-floating mb-3">
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
            <label for="email">Enter Registered Email</label>
            <div class="form-text">This email refers to the one associated with your order.</div>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" name="orderUUID" id="orderUUID" placeholder="Enter Order ID">
            <label for="orderUUID">Enter Order ID</label>
            <div class="form-text">Your Order ID was sent to you via e-mail at the time of your order!</div>
          </div>
        
      </div>
      <div class="modal-footer">        
        <button type="submit" class="btn btn-primary btn-lg mx-auto">View</button>
      </form>     
      @if(Session('failure'))
        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert" style="text-align: center;">
          <strong>{{session('failure')}}</strong>
          <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
      @endif
      </div>
    </div>
  </div>
</div>
