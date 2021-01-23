@php
    $name=$infoarray[2];
    $type=$infoarray[1];
    $create_route=$infoarray[0];
@endphp
{{-- for body wood, top wood, fretboard wood, neck wood --}}

<div class="col-md-11 mx-auto mt-10">
    <div class="row">
            
        <div class="col-md-11">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            All {{$name}}
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">{{$name}}</th>
                                <th scope="col">Description</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldata as $data)
                                <tr>
                                    <td>{{$data->type}}</td>
                                    <td>{{$data->description}}</td>
                                    <td><a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/edit/'.$data->id)}}" class="btn btn-info btn-sm">Edit</a></td>           
                                    <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{'delete-'.$data->id}}">Delete</button></td>
                                </tr>
                                {{-- delete confirmation modal --}}
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
                                    <label for="type">Enter {{$name}} Type</label>
                                    <input class="form-control" type="text" name="type" id="type" placeholder="Enter {{$infoarray[2]}} Type">
                                </div>
                                {{-- extra wood option "Category" --}}
                                {{-- @if($type=="wood" ||$type=="body wood" ||$type=="top wood" || $type=="fretboard wood" || $type=="neck wood") --}}
                                {{-- checkboxes --}}
                                <div class="mb-3 container-fluid" style="margin:0px;padding:0px;">
                                    <label>Wood Category (Select All Applicable)</label>
                                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" class="btn-check" name="bodywood" id="bodywood" value="Yes" autocomplete="off" @php
                                                if($type=="body wood")
                                                echo "checked";
                                            @endphp>
                                            <label class="btn btn-outline-success" for="bodywood">Body Wood</label>
                                        
                                            <input type="checkbox" class="btn-check" name="topwood" id="topwood" value="Yes" autocomplete="off"@php
                                            if($type=="top wood")
                                            echo "checked";
                                            @endphp>
                                            <label class="btn btn-outline-success" for="topwood">Top Wood</label>

                                            <input type="checkbox" class="btn-check" name="neckwood" id="neckwood" value="Yes" autocomplete="off" @php
                                            if($type=="neck wood")
                                            echo "checked";
                                            @endphp>
                                            <label class="btn btn-outline-success" for="neckwood">Neck Wood</label>

                                            <input type="checkbox" class="btn-check" name="fretboardwood" id="fretboardwood" value="Yes" autocomplete="off" @php
                                            if($type=="fretboard wood")
                                            echo "checked";
                                            @endphp>
                                            <label class="btn btn-outline-success" for="fretboardwood">Fretboard Wood</label>
                                        </div>
                                </div>
                                {{-- @endif --}}
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description"></textarea>
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
    </div>
</div>