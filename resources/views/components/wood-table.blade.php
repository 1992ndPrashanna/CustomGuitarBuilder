{{-- pass info array and all data --}}

@php
    $name=$infoarray[2];
    $type=$infoarray[1];
    $create_route=$infoarray[0];
@endphp
{{-- only for Woods  --}}
<div class="col-md-11 mx-auto mt-10" >
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">All Woods</div>
            </div>
            <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                <thead class="table-dark">
                        <tr>
                            <th scope="col" rowspan="2">{{$name}}</th>
                            <th scope="col" colspan="4">Category</th>
                            <th scope="col" rowspan="2">Description</th>
                            <th scope="col" colspan="2" rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th scope="col">Body</th>
                            <th scope="col">Top</th>
                            <th scope="col">Fretboard</th>
                            <th scope="col">Neck</th>
                        </tr>
                </thead>
                <tbody>
                    @foreach ($alldata as $data)
                        <tr>
                            <td>{{$data->type}}</td>
                            <td>
                                {{--Body Wood Type--}}
                                @if ($data->is_body === "Yes")
                                <i class="fas fa-check"></i>
                                @else
                                <i class="fas fa-times"></i>
                                @endif
                            </td>
                            <td>
                                @if ($data->is_top === "Yes")
                                <i class="fas fa-check"></i>
                                @else
                                <i class="fas fa-times"></i>
                                @endif
                            </td>
                            <td>
                                @if ($data->is_fretboard === "Yes")
                                <i class="fas fa-check"></i>
                                @else
                                <i class="fas fa-times"></i>
                                @endif
                            </td>
                            <td>
                                @if ($data->is_neck === "Yes")
                                <i class="fas fa-check"></i>
                                @else
                                <i class="fas fa-times"></i>
                                @endif
                            </td>
                            <td>
                            @php
                            echo substr($data->description,0,50)."...";
                            @endphp
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


        <div class="col-md-4 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Create {{$name}}</h4>
                </div>
                <div class="card-body">

                    <form action="{{route($create_route)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="type">Enter {{$name}} type</label>
                            <input class="form-control" type="text" name="type" id="type" placeholder="Enter {{$infoarray[2]}} Type">
                        </div>
                        {{-- extra wood option "Category" --}}
                        {{-- checkboxes --}}
                        <div class="mb-3 container-fluid" style="margin:0px;padding:0px;">
                            <label>Wood Category (Select All Applicable)</label>
                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" name="bodywood" id="bodywood" value="Yes" autocomplete="off">
                                    <label class="btn btn-outline-success" for="bodywood">Body Wood</label>
                                
                                    <input type="checkbox" class="btn-check" name="topwood" id="topwood" value="Yes" autocomplete="off"@php
                                    if($type=="top wood")
                                    echo "checked";
                                    @endphp>
                                    <label class="btn btn-outline-success" for="topwood">Top Wood</label>

                                    <input type="checkbox" class="btn-check" name="neckwood" id="neckwood" value="Yes" autocomplete="off">
                                    <label class="btn btn-outline-success" for="neckwood">Neck Wood</label>

                                    <input type="checkbox" class="btn-check" name="fretboardwood" id="fretboardwood" value="Yes" autocomplete="off">
                                    <label class="btn btn-outline-success" for="fretboardwood">Fretboard Wood</label>
                                </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <button class="btn btn-success btn-lg">Create {{$name}}</button>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>  
                    @endif
                    @error('type')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

        </div>
    </div>
</div>