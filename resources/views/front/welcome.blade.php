@extends('layouts.frontend')
@section('title')
    Sahana Guitars - Made In Nepal
@endsection

@section('content')
<style>
    body{
        background-color:#000;
        margin:0px;
        padding:0px;
    }


    .intro-button > a:hover {
        color:#000!important;
        background-color:#fff;
    }

    .btn-outline-info {
        border:none; color:#fff;
    }
    
    .welcome-buttons > a{
        padding-top:30px;
        padding-bottom:30px;
        padding-left:50px;
        padding-right:50px;
    }

    .welcome-buttons > a:hover {
        background-color: #000;
        color:#fff;
        border-color:#fff;
        text-transform: capitalize;
        box-shadow: 5px 10px #000000;
        /* box-shadow: <inset*> <offset-x> <offset-y> <blur-radius*> <spread-radius*> <color*>; */
    }
    
    .btn-info{
        background-color: rgba(0, 0, 0, .6);
        color:#fff;
        border-color: #fff;
    }


</style>
{{-- screen one --}}
<div class="container-fluid" id="video-container" style="width:100vw;height:100vh; margin:0px;padding:0px;">
    
    <div class="video_div mx-auto" style="width:100%; height:100%; min-height:100%,min-width:100%; overflow-x:hidden;overflow-y:hidden; margin-top:0px;"
    data-vide-bg="/storage/background_videos/SGBGVideo" data-vide-options="loop: true, muted: true, position: 0% 0%">
        <div class="overlay" style="z-index: 5;" style="height: 100%;">
            <div class="welcome-buttons d-flex justify-content-center" style="display: inline-block;"> 
                <a href="#" class="btn btn-lg btn-info rounded-0" style="font-size:25px;">Guitars</a>
                <a href="{{route('view.all.pickups')}}" class="btn btn-lg btn-info rounded-0" style="font-size:25px;">Pickups</a>
            </div>
              
            <div class="about-us" style="margin:0px;padding:20px;position: absolute; bottom:0px; text-align:center; background-color:rgba(0,0,0,.5); width:100%">
                Established in 2012, "Sahana Guitars" manfuactures premium instruments from locally sourced woods at an affordable price.
            </div>
        </div>
        
    </div>

</div>

{{-- screen two --}}
<div class="container-fluid col-md-10" id="about-us" style="margin-top:0px;">  
    <div class="row">
        <div class="col-md-5" style="margin-top: 0px;">
            <img class="img-fluid about-us-image" src="{{asset("/storage/frontend_images/nice.jpg")}}" alt="">
        </div>
        <div class="col-sm text-justify align-middle" style="color:#fff; padding:30px;display:table;text-align:center; display:inline;">
            <h1 style="margin-top: 50px; margin-top:50px;">Who are we?</h1>
            <div style="margin-bottom:20px;">
            We are a Boutique Guitar manufacturing company who manufactures Guitars using local woods found in Nepal. We realized that very few people in Nepal were into manufacturing guitars whereas there were lots of traders and found out Nepalese wood were as good as if not better than any other wood used by international brands. Since the possibility was there,We decided to build Guitars. A lot of research went on to finding woods feasible for making guitars and above that, seasoning the woods to the right moisture content by building our own wood drying kiln for consistency.. Besides building Guitar we also make our Own Sahana Pickups for that we had to build a lot of prototypes for proper calibration of the different model of pickups for different genre specific players. We also Provide utility  Products like The Uniform Gig bag, Gear bag , Tour bag and D’Addario Strings. We also are officially associated with Global Brands like Hipshot, Graphtech, EMG Pickups and Fishman pickups. 
            </div>
            {{-- logo cards --}}
            <div class="row row-cols-1 row-cols-5 g-4 mx-auto justify-content-center" style="max-height: 100px;">
                @php
                    $brand_urls= ['emg.png','fishman.png','graphtech.png','hipshot.png'];
                @endphp
                @foreach ($brand_urls as $image)
                <div class="col" style="margin-top: 25px;">
                    <div class="d-inline-block" style="background-color: rgba(0, 0, 0, 0); ">
                      <img class="" src="{{asset('/storage/associates/'.$image)}}" class="card-img-top" alt="..." style="margin-top:auto;height:50%; width:75%;">
                    </div>
                  </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>

{{-- screen three --}}
<div class="container-fluid col-md-10">
    
</div>

{{-- <div class="screen_one" style="background-image: url('{{URL::asset("storage/frontpage_backgrounds/SGBackground1.jpg")}}')">
    <div class="overlay">
    </div>
</div>
<div class="screen_two" style="background-image: url('{{URL::asset("storage/frontpage_backgrounds/SGBackground.jpg")}}')">
    <div class="overlay">
    </div>
</div>
<div class="screen_three">
</div>
<div class="screen_four">
</div> --}}

<script>
    let intViewportWidth = window.innerWidth;
    // document.getElementById('video-container').setAttribute("style","width:1920px");
</script>

@endsection