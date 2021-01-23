  
    @php
    $type=$infoarray[0];
    $name=$infoarray[1];
@endphp
<div class="container-fluid mt-10">
    <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit {{$name}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{url('/products/guitar/'.str_replace(" ","",$type).'/update/'.$edit->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="type">Edit {{$name}} type</label>
                                    <input class="form-control" type="text" name="type" id="type" value="{{$edit->type}}">
                                </div>

                                
                                {{-- checkboxes --}}
                                <div class="mb-3 container-fluid" style="margin:0px;padding:0px;">
                                    <label> Edit Wood Category (Select/Change All Applicable)</label>
                                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" class="btn-check" name="bodywood" id="bodywood" value="Yes" autocomplete="off" @php
                                                if($edit->is_body=="Yes")
                                                echo "checked";
                                            @endphp>
                                            <label class="btn btn-outline-success" for="bodywood">Body Wood</label>
                                        
                                            <input type="checkbox" class="btn-check" name="topwood" id="topwood" value="Yes" autocomplete="off"@php
                                            if($edit->is_top=="Yes")
                                            echo "checked";
                                        @endphp>
                                            <label class="btn btn-outline-success" for="topwood">Top Wood</label>
    
                                            <input type="checkbox" class="btn-check" name="neckwood" id="neckwood" value="Yes" autocomplete="off" @php
                                            if($edit->is_neck=="Yes")
                                            echo "checked";
                                        @endphp>
                                            <label class="btn btn-outline-success" for="neckwood">Neck Wood</label>
    
                                            <input type="checkbox" class="btn-check" name="fretboardwood" id="fretboardwood" value="Yes" autocomplete="off" @php
                                            if($edit->is_fretboard=="Yes")
                                            echo "checked";
                                        @endphp>
                                            <label class="btn btn-outline-success" for="fretboardwood">Fretboard Wood</label>
                                        </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description">{{$edit->description}}</textarea>
                                </div>
                                <button class="btn btn-success btn-lg">Update {{$name}}</button>
                                <a href="javascript:history.go(-1)" class="btn btn-lg btn-info">Cancel</a>
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