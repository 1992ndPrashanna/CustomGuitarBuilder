@php
$i=0;
@endphp

{{-- <div class="card-group mx-10 mb-20" style="display: flex;">
    @foreach ($pickups as $pickup)
    @php
        $exploded_images_array=explode(",",$pickup->image_urls)
    @endphp

    <div class="card-container mr-5">
        <div class="card my-5 p-0 m-0" style="max-width: 200px;min-width:200px; max-height:250px;min-height:250px; font-size:12px; text-align:center">
            <div class="image_container d-flex justify-content-center " style="object-fit:contain;">
                <img src= class="card-img-top" alt="Pickup Image" style="max-width: 200px;min-width:200px; max-height:200px;min-height:200px;">
            </div>
            <div class="card-body">
                <p class="card-text">{{$pickup->name}}</p>
            </div>
        </div>
    </div>

    @endforeach
</div> --}}

<div class="card-group pb-5 " style="color: #fff;" >

    @foreach ($pickups as $pickup)
    @php
        $exploded_images_array=explode(",",$pickup->image_urls);
        $urlname=str_replace([' ','(','&',')','$'.'@','-','_','#','!'],'',$pickup->name);
        $pickup_view_url='/view/'.$urlname.'/'.$pickup->id;
    @endphp
    <div class="card" style="max-height: 200px;max-width:200px;min-height:200px;">
        <a href="{{$pickup_view_url}}" style="margin: 0px; padding:0px;"><img src="{{asset($exploded_images_array[0])}}" class="card-img-top" alt="Pickup Image" style="max-height: 200px;max-width:300px;min-height:200px;"></a>
      <div class="card-body" style="background-color: #000; padding:0px; min-height:50px;" >
        <h5 class="card-title " style="text-align: center; background-color:#000;color:#fff; padding:0px;"><a href="{{$pickup_view_url}}" style="text-decoration: none;color:#fff; font-size:15px;">{{str_replace('Pickup','',$pickup->name)}}</a></h5>
      </div>
    </div>

    @endforeach

  </div>