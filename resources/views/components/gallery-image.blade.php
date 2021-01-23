<div>
    <style>
        /* images inside carousel slideshow */
        .carosel-image {
            height: 75vh;
            object-fit: contain;
        }
        /* slideshow icons color inverted*/
        .carousel-control-next-icon,
        .carousel-control-prev-icon {
        filter: invert(1);
        }
    
        table, th, td {
            border: 1px solid black;
        }
        table {
            background-color:#fff;
        }

        /* required option */
    
        .card img {
            height: 200px;
            object-fit: fill;
        }
    
        .card a {
            text-decoration: none;
            color:#000;
        }
    
        .custom-shop-gallery-header {
            font-family: 'Kanit', sans-serif;
            text-align: center;
        }
    
        .custom-shop-gallery-sub-header{
            font-family: 'Montserrat', sans-serif;;
            text-align: center;
        }
    
        .hand-cursor .col .card img {
            cursor: pointer;
        }

        .col {
            border: 1px solid #cfcfcf padding:0px;
        }

        .action-buttons a {
            margin-right:10px;
            margin-left:10px;
        }

    
    </style>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <div class="col-md-11 mx-auto mt-10">
        <div class="row">
            <div class="col-md-8">
                {{-- view images here --}}
                <div class="card">
                    <div class="card-header">
                        All Gallery Images
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                        @endif
                        {{-- image loop --}}
                        @php
                            $i=0;
                        @endphp
                        {{$imageUrls->links()}}
                        <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-3 hand-cursor" id="gallery">
                            {{--small images gallery loop --}}
                            @foreach ($imageUrls as $url)
                                <div class="col" style="">
                                    <div class="card" data-bs-toggle="modal" data-bs-target="#slideShow">
                                        <img  src="{{asset($url->image_url)}}" class="card-img-top" alt="..." data-bs-slide-to="{{$i}}" data-bs-target="#carouselExampleControls">
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                    
                                    <div class="d-flex justify-content-center action-buttons">
                                        @if($url->deleted_at!="")
                                        <a href="{{route('galleryimage.hide',$url->id)}}" class="btn btn-sm btn-info">Show</a>
                                        @else
                                        <a href="{{route('galleryimage.hide',$url->id)}}" class="btn btn-sm btn-success">Hide</a>
                                        @endif
                                        <a href="{{route('galleryimage.delete',$url->id)}}" class="btn btn-sm btn-danger">Remove</a>
                                    </div>
                                    
                                </div>                                
                            @endforeach                           
                        </div>                        
                    </div>
                </div>
            </div>
            {{-- slideshow modal --}}
                <div class="modal fade" id="slideShow" tabindex="-1" aria-labelledby="slideShowLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="slideShowLabel" style="text-align: center;">Gallery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        {{-- carousel loop --}}
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach($imageUrls as $url)
                                        <div class="carousel-item <?php if($i==0) echo 'active'; ?>">
                                            <img src="{{asset($url->image_url)}}" class="d-block w-100 carosel-image" alt="...">
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach                                    
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            <div class="col-md-4">
                {{-- insert form --}}
                <div class="card">
                    <div class="card-header">
                        Upload Image for Custom Shop Gallery
                    </div>
                    <div class="card-body">
                        <form action="{{route('galleryimage.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input name="image" id="image" type="file" class="form-control">    
                            </div> 
                            <div class="mb-3">
                                <button class="btn btn-lg btn-success">
                                    Upload
                                </button>    
                            </div>                           
                        </form>

                    </div>
                </div>
            </div>
        </div>
        
</div>