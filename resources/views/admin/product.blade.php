@extends ('admin/layout')
@section('page_title','product')
@section('product_select', 'active')
@section('container')
<div class=" au-card--no-shadow
            au-card--no-pad m-b-40">
            <h3>product</h3>
</div>
<a href="{{url('admin/product/manage_product')}}"><button type="button" class="btn btn-info">Add Product</button></a>

<div class="alert-success m-t-10" role="alert">
    {{session('message')}}
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->slug}}</td>
                        @if($list->image!='')
                        <td><img width="100px" src="{{asset('storage/media/'.$list->image)}}"/></td>
                        @endif


                        <td>
                            <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="{{url('admin/product/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>

                            @if($list->status==1)
                            <a href="{{url('admin/product/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                            @elseif($list->status==0)
                            <a href="{{url('admin/product/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-outline-primary">Deactive</button></a>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>


@endsection
