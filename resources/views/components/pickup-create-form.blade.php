
          <div class="form-group row">
            <div class="col-sm-12">
              <input type="text" class="form-control" name={{\Request::is('products/pickups/brands')? "brand":"type"}} "type" id="type" placeholder="{{$pagename}}">
            </div>
          </div>
          @if (!\Request::is('products/pickups/brands'))    
            <div class="form-group my-2">
                <textarea class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
            </div>
          @endif

          @if (\Request::is('products/pickups/brands'))

            <div class="mb-3">
                <label for="brand_image" class="form-check-label">Upload Brand Image</label>
                <input type="file" class="form-control" name="brand_image" id="brand_image">
            </div>
          @endif



          <div class="form-group">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Add {{$pagename}}</button>
            </div>
          </div>
        </form>
      {{-- End Form --}}

      {{-- success message --}}
      @if(session('success'))
      <div class="alert alert-warning alert-success fade show" role="alert">
        {{session('success')}}
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>  
      @endif

      {{-- eror messages --}}
        @error('type')
          <div class="text-danger">{{$message}}</div>
        @enderror
          
        
          @error('brand')
          <div class="text-danger">{{$message}}</div>
          @enderror
          @error('brand_image')
          <div class="text-danger">{{$message}}</div>
          @enderror
       

      </div>
    </div>

  {{-- end card --}}
  
      
  
  </div>