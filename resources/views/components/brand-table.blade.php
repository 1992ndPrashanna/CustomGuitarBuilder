@php
    $name=$infoarray[2];
    $type=$infoarray[1];
    $create_route=$infoarray[0];
@endphp
<style>
    .brand-image{
        min-width: 100px;
        max-width: 100px;
    }
</style>
{{-- table for Tuner Brand, Bridge Brand, Frets Brand or any other brand --}}
<div class="col-md-11 mt-10 mx-auto">
    <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$name}}</div>
                </div>
                <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Logo</th>
                            <th scope="col" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alldata as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td class="d-flex justify-content-center"><img class="brand-image" src="{{asset($data->image_urls)}}" width="100" alt=""></td>
                                <td><a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/edit/'.$data->id)}}" class="btn btn-info btn-sm">Edit</a></td>           
                                <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{'delete-'.$data->id}}">Delete</button></td>
                            </tr>

                            <div class="modal fade" id="{{'delete-'.$data->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="">Delete {{$data->type}} Permanently?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>{{$data->name}}</strong> will be permanenly deleted!
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/delete/'.$data->id)}}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add {{$name}}
                    </div>
                    <div class="card-body">
                        <form action="{{route($create_route)}}" method="POST" enctype=multipart/form-data>
                            @csrf
                            <div class="mb-3">
                                <label for="name">Brand Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="brand_image">Select Image</label>
                                <input type="file" class="form-control" name="brand_image" id="brand_image">
                            </div>                
                            <button class="btn btn-lg btn-success">Add {{$name}}</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>