@extends ('admin/layout')
@section('page_title','manage_brand')
@section('container')
@section('brand_select', 'active')

<div class=" au-card--no-shadow
            au-card--no-pad m-b-40">
            <h3>Manage Brand</h3>
</div>
<a href="{{url('admin/brand')}}"><button type="button" class="btn btn-success">Back</button></a>

@if($id>0)
    @php
        $image_required =""
    @endphp
@else
    @php
        $image_required = "required"
    @endphp
@endif
<div class="alert-danger m-t-10" role="alert">
    @error('image.*')
        {{message}}
    @enderror
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">

                        <form action="{{route('brand.manage_brand_process')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="control-label mb-1">Name</label>
                                <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label for="image" class="control-label mb-1">Image</label>
                              <input id="image" name="image" type="file" class="form-control"
                              aria-required="true" aria-invalid="false" {{ $image_required }}>
                              @error('image')
                              <div class="alert alert-danger" role="alert">
                                 {{ $message }}
                              </div>
                              @enderror
                              @if($image!='')
                        <td><img width="100px" src="{{asset('storage/media/brand/'.$image)}}"/></td>
                        @endif
                           </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    Submit
                                </button>
                            </div>
                                <input type="hidden" name="id" value="{{$id}}"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
