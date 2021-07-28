@extends ('admin/layout')
@section('page_title', 'manage_product')
@section('container')
@section('product_select', 'active')

@if($id>0)
    @php
    $image_required =""
    @endphp
@else
    @php
    $image_required = "required"
    @endphp
@endif

<div class=" au-card--no-shadow
   au-card--no-pad m-b-10">
   <h3>Manage Product</h3>
</div>
<a href="{{ url('admin/product') }}"><button type="button" class="btn btn-success">Back</button></a>
<script type="text/javascript" src="{{asset('ckeditor/ckeditor.js')}}"></script>

<div class="alert-danger m-t-10" role="alert">
    {{session('sku_error')}}
</div>
<div class="alert-danger m-t-10" role="alert">
    @error('attr_image.*')
        {{message}}
    @enderror
</div>
<div class="alert-danger m-t-10" role="alert">
    @error('images.*')
        {{message}}
    @enderror
</div>

<div class="row m-t-10">
   <div class="col-md-12">
      <form action="{{ route('product.manage_product_process') }}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header"><strong>Add Product</strong></div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="name" class="control-label mb-1">Name</label>
                              <input id="name" value="{{ $name }}" name="name" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" required>
                              @error('name')
                              <div class="alert alert-danger" role="alert">
                                 {{ $message }}
                              </div>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="slug" class="control-label mb-1">Slug</label>
                              <input id="slug" value="{{ $slug }}" name="slug" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" required>
                              @error('slug')
                              <div class="alert alert-danger" role="alert">
                                 {{ $message }}
                              </div>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
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
                              <td><img width="100px" src="{{asset('storage/media/'.$image)}}"/></td>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="category_id" class="control-label mb-1">Category</label>
                              <select name="category_id" id="category_id" class="form-control" required>
                                 <option value="">Select Category</option>
                                 @foreach ($category as $list)
                                 @if ($category_id == $list->id)
                                 <option selected value="{{ $list->id }}">
                                    @else
                                 <option value="{{ $list->id }}">
                                    @endif
                                    {{ $list->category_name }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="brand" class="control-label mb-1">Brand</label>
                              <select name="brand" id="brand" class="form-control" required>
                                 <option value="">Select Brand</option>
                                 @foreach ($brands as $list)
                                 @if ($brand == $list->id)
                                 <option selected value="{{ $list->id }}">
                                    @else
                                 <option value="{{ $list->id }}">
                                    @endif
                                    {{ $list->name }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="model" class="control-label mb-1">Model</label>
                              <input id="model" value="{{ $model }}" name="model" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="short_desc" class="control-label mb-1">Short Description</label>
                              <textarea id="short_desc" name="short_desc" type="text" class="form-control"
                                 aria-required="true" aria-invalid="false" required
                                 rows="3">{{ $short_desc }}</textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="desc" class="control-label mb-1">Description</label>
                              <textarea id="desc" value="{{ $desc }}" name="desc" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" required
                                 rows="3">{{ $desc }}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="keywords" class="control-label mb-1">Keywords</label>
                              <input id="keywords" value="{{ $keywords }}" name="keywords" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="technical_specification" class="control-label mb-1">Technical
                              Specification</label>
                              <input id="technical_specification" value="{{ $technical_specification }}"
                                 name="technical_specification" type="text" class="form-control"
                                 aria-required="true" aria-invalid="false">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="uses" class="control-label mb-1">Uses</label>
                              <input id="uses" value="{{ $uses }}" name="uses" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="warranty" class="control-label mb-1">Warranty</label>
                              <input id="warranty" value="{{ $warranty }}" name="warranty" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="lead_time" class="control-label mb-1">Lead Time</label>
                              <input id="lead_time" value="{{ $lead_time }}" name="lead_time" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" >
                           </div>
                        </div>
                     </div>
                      <div class="row">
                          <div class="col-md-4">
                           <div class="form-group">
                              <label for="tax" class="control-label mb-1">Tax</label>
                              <input id="tax" value="{{ $tax }}" name="tax" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="tax_type" class="control-label mb-1">Tax Type</label>
                              <input id="tax_type" value="{{ $tax_type }}" name="tax_type" type="text"
                                 class="form-control" aria-required="true" aria-invalid="false" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                <select name="is_promo" id="is_promo" class="form-control" required>
                                    @if($is_promo=='1')
                                 <option value="1" selected>YES</option>
                                  <option value="0">NO</option>
                                    @else
                                     <option value="1">YES</option>
                                     <option value="0" selected>NO</option>
                                     @endif
                                </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                         <div class="col-md-4">
                           <div class="form-group">
                              <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                <select name="is_featured" id="is_featured" class="form-control" required>
                                 @if($is_featured=='1')
                                 <option value="1" selected>YES</option>
                                  <option value="0">NO</option>
                                    @else
                                     <option value="1">YES</option>
                                     <option value="0" selected>NO</option>
                                     @endif
                                </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                <select name="is_discounted" id="is_discounted" class="form-control" required>
                                @if($is_discounted=='1')
                                 <option value="1" selected>YES</option>
                                  <option value="0">NO</option>
                                    @else
                                     <option value="1">YES</option>
                                     <option value="0" selected>NO</option>
                                     @endif
                                </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="is_tranding" class="control-label mb-1">Is Tranding</label>
                                <select name="is_tranding" id="is_tranding" class="form-control" required>
                                @if($is_tranding=='1')
                                 <option value="1" selected>YES</option>
                                  <option value="0">NO</option>
                                    @else
                                     <option value="1">YES</option>
                                     <option value="0" selected>NO</option>
                                     @endif
                                </select>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="id" value="{{ $id }}" />
                  </div>
               </div>
            </div>
         </div>
         <div class="card-title">
            <h3 class="text-center title-2">ADD Details</h3>
         </div>
         <hr>
         <div class="col-lg-12" id="produt_attr_box">
            @php
                 $loop_count_num=1;

            @endphp

             @foreach($products_attributeArr as $key => $val)
             <?php
                $loop_count_prev=$loop_count_num;
                $pAArr=(array)$val;
             ?>
            <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
            <div class="card" id="product_attr_{{$loop_count_num++}}" >
                <div class="card-body">
                   <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input id="sku" value="{{$pAArr['sku']}}" name="sku[]" type="text" class="form-control"
                               aria-required="true" aria-invalid="false" required>
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                            <label for="attr_image" class="control-label mb-1">Image</label>
                            <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true"
                               aria-invalid="false">
                               @if($pAArr['attr_image']!='')
                               <td><img width="100px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}"/></td>
                               @endif
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                            <label for="mrp" class="control-label mb-1">MRP</label>
                            <input id="mrp" value="{{$pAArr['mrp']}}" name="mrp[]" type="text" class="form-control"
                               aria-required="true" aria-invalid="false" required>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="size_id" class="control-label mb-1">Size</label>
                            <select name="size_id[]" id="size_id" class="form-control">
                               <option value="">Select Size</option>
                               @foreach ($size as $list)
                               @if($pAArr['size_id']==$list->id)
                               <option value="{{ $list->id }}" selected >{{ $list->size }}</option>
                                @else
                                <option value="{{ $list->id }}">{{ $list->size }}</option>
                               @endif

                               @endforeach
                            </select>
                         </div>
                      </div>
                      <div class="col-md-6">
                         <div class="form-group">
                            <label for="category_id" class="control-label mb-1">Color</label>
                            <select name="color_id[]" id="color_id" class="form-control" >
                               <option value="">Select Color</option>
                               @foreach ($color as $list)
                               @if($pAArr['color_id']==$list->id)
                               <option value="{{ $list->id }}" selected>{{ $list->color }}</option>
                                @else
                                <option value="{{ $list->id }}">{{ $list->color }}</option>
                               @endif
                               @endforeach
                            </select>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" value="{{$pAArr['price']}}" name="price[]" type="text" class="form-control"
                               aria-required="true" aria-invalid="false" required>
                         </div>
                      </div>
                      <div class="col-md-4">
                         <div class="form-group">
                            <label for="quantity" class="control-label mb-1">Quantity</label>
                            <input id="quantity" value="{{$pAArr['quantity']}}" name="quantity[]" type="text" class="form-control"
                               aria-required="true" aria-invalid="false" required>
                         </div>
                      </div>
                      <div class="col-md-4">
                         <label for="" class="control-label mt-4">&nbsp;&nbsp;&nbsp</label>
                         @if($loop_count_num==2)
                         <button type="button" class="btn btn-success btn-lg" onclick="add_more()"><i class="fas fa-plus"></i>&nbsp; ADD</button>
                         @else
                         <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg"><i class="fas fa-trash-alt"></i>&nbsp; Remove</button></a>
                         @endif

                      </div>
                   </div>
                </div>
             </div>
             @endforeach
         </div>

         <div class="card-title">
            <h3 class="text-center title-2">ADD More Image</h3>
         </div>
         <hr>
         <div class="col-lg-12" >
            <div class="card"  >
                <div class="card-body">
                   <div class="form-group">
                       <div class="row" id="produt_image_box">
                    @php
                    $loop_count_num=1;
                    @endphp

                        @foreach($products_imageArr as $key => $val)
                        <?php
                        $loop_count_prev=$loop_count_num;
                        $pIArr=(array)$val;
                        ?>
                        <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">

                             <div class="col-md-4 product_images_{{$loop_count_num++}}" >
                                <label for="images" class="control-label mb-1">Image</label>
                                <input id="images" name="images[]" type="file" class="form-control" aria-required="true"
                                aria-invalid="false">
                                @if($pIArr['images']!='')
                                <a href="{{asset('storage/media/'.$pIArr['images'])}}" target="_blank"><img width="100px" src="{{asset('storage/media/'.$pIArr['images'])}}"/></a>
                                @endif
                             </div>

                             <div class="col-md-2">
                                <label for="" class="control-label mt-4">&nbsp;&nbsp;&nbsp</label>
                                @if($loop_count_num==2)
                                <button type="button" class="btn btn-success btn-lg" onclick="add_images_more()"><i class="fas fa-plus"></i>&nbsp; ADD</button>
                                @else
                                <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg"><i class="fas fa-trash-alt"></i>&nbsp; Remove</button></a>
                                @endif
                              </div>

                       @endforeach
                   </div>
                </div>
               </div>
            </div>
          </div>

         </div>

         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            Submit
            </button>
         </div>
      </form>
   </div>
</div>
<script>
   var loop_count=1;
   function add_more(){
       loop_count++;
       var html='<div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="row">';

        html+='<div class="col-md-4"><div class="form-group"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" value="" name="sku[]" type="text" class="form-control"aria-required="true" aria-invalid="false" required></div></div>';
        html+='<div class="col-md-4"><div class="form-group"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true"aria-invalid="false"></div></div>';
        html+='<div class="col-md-4"><div class="form-group"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" value="" name="mrp[]" type="text" class="form-control"aria-required="true" aria-invalid="false" required></div></div>';

        html+='<div class="col-md-6">';
        var size_id_html=jQuery('#size_id').html();
        size_id_html=size_id_html.replace("selected","");

        html+='<div class="form-group"><label for="size_id" class="control-label mb-1">Size</label><select name="size_id[]" id="size_id" class="form-control" required>'+size_id_html+'</select></div>';
        html+='</div>';
        html+='<div class="col-md-6">';
        var color_id_html=jQuery('#color_id').html();
        color_id_html=color_id_html.replace("selected","");
        html+='<div class="form-group"> <label for="color_id" class="control-label mb-1">Color</label><select name="color_id[]" id="color_id" class="form-control" required>'+color_id_html+'</select></div>';
        html+='</div>';
        html+='<div class="col-md-4">';
        html+='<div class="form-group"><label for="price" class="control-label mb-1">Price</label><input id="price" value="" name="price[]" type="text" class="form-control"aria-required="true" aria-invalid="false" required></div></div>';

        html+='<div class="col-md-4">';
        html+='<div class="form-group"><label for="quantity" class="control-label mb-1">Quantity</label><input id="quantity" value="" name="quantity[]" type="text" class="form-control"aria-required="true" aria-invalid="false" required></div></div>';

        html+='<div class="col-md-4">';
        html+='<label for="" class="control-label mt-4">&nbsp;&nbsp;&nbsp</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fas fa-trash-alt"></i>&nbsp; Remove</button></div>';

        html+='</div></div></div></div></div></div>';
        jQuery('#produt_attr_box').append(html)

   }
   function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
    }

   var loop_image_count=1;
   function add_images_more(){
        loop_image_count++;
        var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Image</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true"aria-invalid="false" required></></div>';
            html+='<div class="col-md-2 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fas fa-trash-alt"></i>&nbsp; Remove</button></div>';
            html+='</div></div>';
            jQuery('#produt_image_box').append(html)
   }
   function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
    }
    CKEDITOR.replace('short_desc');
    CKEDITOR.replace('desc');
    CKEDITOR.replace('keywords');
    CKEDITOR.replace('technical_specification');
</script>
@endsection
