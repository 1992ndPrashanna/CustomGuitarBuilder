<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>


    <div class="container">
        <div class="row">
            <div class="col-md-8 my-10">
                <div class="card">
                    <h5 class="card-header">Categories Table</h5>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description/Tags</th>
                                </tr>
                            </thead>
                            {{-- @php
                    $i=1
                @endphp --}}
                            <tbody>

                                @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                    <td>{{$category->category_name}}</td>
                                    @if ($category->description_tags!= NULL)
                                    <td>{{$category->description_tags}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                            {{$categories->links()}}
                        </table>

                    </div>
                </div>
            </div>

            <div class="col-md-4 my-10 ">
                <div class="card">

                    <div class="card-header">

                        Add Category
                    </div>
                    <div class="card-body">
                        {{-- Add Category Form --}}
                        <form action="{{route('create.category')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                {{-- <label for="category-name" class="col-sm-2 col-form-label">Name</label> --}}
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Category Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                {{-- <label for="description" class="col-sm-2 col-form-label">Description</label> --}}
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description or Tags">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Category</button>
                                </div>
                            </div>
                        </form>
                        {{-- End Form --}}

                        {{-- success message --}}
                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        {{-- eror message --}}


                        @error('category_name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                {{-- end card --}}



            </div>
        </div>
    </div>

    <script>


    </script>
</x-app-layout>
