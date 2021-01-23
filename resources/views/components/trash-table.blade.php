<h5 class="card-header">{{$title}}</h5>
<div id="{{$id}}"  class="mb-15">
    <table class="table table-hover table-bordered" style="overflow-x:auto;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{$category=="brand"? "Brand":"Type"}}</th>
                <th scope="col">{{$category=="brand"? "Image":"Description"}}</th>
                <th scope="col" colspan="2">Actions</th>
            </tr>
        </thead>
        @if (count($trashes)==0)
            <td colspan="4">No deleted posts in {{$title}}</td>
            
        @else
            @if ($category=='pickup')
                @foreach ($trashes as $trash)
                <tr>
                    <td class="type_column">
                        {{$trash->name}}
                    </td>
                    @php

                    //     $description_select=explode(" ",strip_tags($trash->description));
                    // $description="";
                    // for($i=0;$i<=20;$i++){
                    //     $description.=$description_select[$i]." ";
                    // }
                    $trash->description=strip_tags($trash->description);
                    $description=substr($trash->description, 0,150)."....";
                    @endphp
                    <td class="description_columm">{{$description}}</td>
                    <td class="delete_column"><a href="{{url('/products/pickups/'.$category.'/restore/'.$trash->id)}}" class="btn btn-sm btn-info">Restore</a></td>
                    <td class="restore_column"><a href="{{url('/products/pickups/'.$category.'/trash/'.$trash->id)}}" class="btn btn-sm btn-danger">Destroy</button></td>
                </tr>
                @endforeach
            @else
                @foreach ($trashes as $trash)
                <tr>
                    <td class="type_column">{{$category == "brand"? "$trash->brand":"$trash->type"}}</td>
                    @if ($category=="brand")
                        <td class="description_column"><img src="{{asset($trash->brand_image)}}" width="100" alt=""></td>
                    @else
                        <td class="description_column">{{$trash->description}}</td> 
                    @endif
                    
                    <td class="delete_column"><a href="{{url('/products/pickups/'.$category.'/restore/'.$trash->id)}}" class="btn btn-sm btn-info">Restore</a></td>
                    <td class="restore_column"><a href="{{url('/products/pickups/'.$category.'/trash/'.$trash->id)}}" class="btn btn-sm btn-danger">Destroy</button></td>
                </tr>
                @endforeach
            @endif
        @endif
    </table>
</div>
