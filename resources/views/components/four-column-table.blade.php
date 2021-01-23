@php
    $name=$infoarray[2];
    $type=$infoarray[1];
    $create_route=$infoarray[0];
@endphp

{{-- trix editor styles --}}
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

{{-- for "type, description" tables --}}

<div class="col-md-11 mx-auto mt-10">
    <div class="row">
        <div class="col-md-8">        
            <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                <thead class="table-dark">
                    <tr>
                        <th>{{$name}}</th>
                        @if ($type=="custom inlay")
                        <th>Image Preview</th>                                                       
                        @endif
                        @if ($type=="shape")
                            <th>Frets</th>
                        @endif
                        @if($type!="color" && $type!="translucent color")
                        <th>Description</th>
                        @endif
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alldata as $data)
                        <tr>
                            <td>{{$data->type}}</td>
                            @if($type=="custom inlay")
                            <td class="d-flex justify-content-center">
                                <img src="{{asset($data->images)}}" width="100" alt="">
                            </td>
                            @endif
                            @if ($type=="shape")
                            <td>
                                {{$data->frets." frets"}}
                            </td>
                            @endif
                            @if($type!="color" && $type!="translucent color")
                                <td>                            
                                @if ($data->description=="")
                                N/A
                                @else 
                                    {{$data->description}}
                                @endif
                            @endif
                            
                            </td>
                            <td><a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/edit/'.$data->id)}}" class="btn btn-info btn-sm">Edit</a></td>           
                            <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{'delete-'.$data->id}}">Delete</button></td>
                        </tr>
                        {{-- delete modal for each item --}}
                        <!-- Modal -->
                        <div class="modal fade" id="{{'delete-'.$data->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="">Delete {{$data->type}} Permanently?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <strong>{{$data->type}}</strong> will be permanenly deleted!
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
            {{$alldata->links()}}
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Add {{$name}}
                </div>
                <div class="card-body">
                    <form id="create-form" action="{{route($create_route)}}"  method="POST" @php
                        if($type=="custom inlay")
                            echo "enctype='multipart/form-data'";
                    @endphp>
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="form-label">Enter {{$name}} Type</label>
                            <input class="form-control" type="text" name="type" id="type" placeholder="{{$name}} Type">
                        </div>

                        @if ($type!="bridge color" && $type!="bridge scale" && $type!="bridge type" && $type!="payment options")
                            <div class="mb-3">
                                {{-- color,type and scale have no "description" --}}
                                <label for="description" class="form-label">Enter Description (Optional)</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                            </div>
                        @endif

                        {{-- payment option description with trix editor --}}
                        @if($type=="payment options")
                        <div class="my-2" style="font-size: 16px;">
                            <label for="description">Enter Payment Options Details</label>
                            <input type="hidden" name="description" id="description" class="trix-description" value="">
                            <trix-editor input="description" class="form-control" name></trix-editor>
                        </div>
                        @endif
                        {{-- end payment options description --}}

                        @if($type=="shape")
                            <div class="mb-3">
                                <label for="frets" class="form-label">Number of frets: </label><br>
                                <select class="form-select" name="frets" id="frets">
                                    <option value="24">24</option>
                                    <option value="22">22</option>                                    
                                </select>
                            </div>
                        @endif
                        @if ($type=="custom inlay")

                        <div class="mb-3">
                            <label for="guitar_model">Model</label>
                            <select class="form-select" name="guitar_model" id="guitar_model">
                                <option value="">Select Guitar Model</option>
                                @foreach ($guitarmodels as $guitar_model)
                                    <option value="{{$guitar_model->id}}">{{$guitar_model->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Upload {{$name}} Image (Optional)</label>
                            <input class="form-control" type="file" name="images" id="images">
                        </div>
                        @endif

                        

                        <button id="submit" class="btn btn-lg btn-success">Create {{$name}}</button>
                    </form>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  

                    @elseif (session('failure'))
                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                            <strong>{{session('failure')}}</strong>
                            <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                    @endif

                    @error('type')
                        {{$message}}
                    @enderror

                </div>
            </div>
        </div>
    </div>
</div>
