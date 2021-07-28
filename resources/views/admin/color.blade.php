@extends ('admin/layout')
@section('page_title','color')
@section('color_select', 'active')
@section('container')
<div class=" au-card--no-shadow
            au-card--no-pad m-b-40">
            <h3>Color</h3>
</div>
<a href="{{url('admin/color/manage_color')}}"><button type="button" class="btn btn-info">Add Color</button></a>

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
                        <th>Color</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->color}}</td>
                        <td>
                            <a href="{{url('admin/color/manage_color/')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="{{url('admin/color/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Delete</button></a>

                            @if($list->status==1)
                            <a href="{{url('admin/color/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Active</button></a>
                            @elseif($list->status==0)
                            <a href="{{url('admin/color/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-outline-primary">Deactive</button></a>
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
