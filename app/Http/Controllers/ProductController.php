<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=Product::all();
       return view('admin/product',$result);
    }

    public function manage_product(Request $request, $id='')
    {
        if($id>0){
            $arr=Product::where(['id'=>$id])->get();

            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']=$arr['0']->slug;
            $result['brand']=$arr['0']->brand;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;

            $result['lead_time']=$arr['0']->lead_time;
            $result['tax']=$arr['0']->tax;
            $result['tax_type']=$arr['0']->tax_type;
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;

            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
            $result['products_attributeArr']=DB::table('products_attribute')->where(['product_id'=>$id])->get();
            $products_imageArr=DB::table('products_image')->where(['product_id'=>$id])->get();

            if(!isset($products_imageArr[0])){
                $result['products_imageArr'][0]['id']='';
                $result['products_imageArr'][0]['images']='';
            }
            else{
                $result['products_imageArr']=$products_imageArr;
            }

        }else{

            $result['category_id']='';
            $result['name']='';
            $result['image']='';
            $result['slug']='';
            $result['brand']='';
            $result['model']='';
            $result['short_desc']='';
            $result['desc']='';
            $result['keywords']='';
            $result['technical_specification']='';
            $result['uses']='';
            $result['warranty']='';
            $result['status']='';
            $result['id']=0;
            $result['lead_time']='';
            $result['tax']='';
            $result['tax_type']='';
            $result['is_promo']='';
            $result['is_featured']='';
            $result['is_discounted']='';
            $result['is_tranding']='';

            $result['products_attributeArr'][0]['id']='';
            $result['products_attributeArr'][0]['product_id']='';
            $result['products_attributeArr'][0]['sku']='';
            $result['products_attributeArr'][0]['attr_image']='';
            $result['products_attributeArr'][0]['mrp']='';
            $result['products_attributeArr'][0]['price']='';
            $result['products_attributeArr'][0]['quantity']='';
            $result['products_attributeArr'][0]['size_id']='';
            $result['products_attributeArr'][0]['color_id']='';

            $result['products_imageArr'][0]['id']='';
            $result['products_imageArr'][0]['images']='';


        }

            $result['category']=DB::table('categories')->where(['status'=>1])->get();
            $result['size']=DB::table('sizes')->where(['status'=>1])->get();
            $result['color']=DB::table('colors')->where(['status'=>1])->get();
            $result['brands']=DB::table('brands')->where(['status'=>1])->get();
        return view('admin/manage_product',$result);
    }

    public function manage_product_process(Request $request)
    {
        //return $request->post();
        //die();
        if($request->post('id')>0){
            $image_validation="mimes:jpeg,jpg,png";

        }else{
            $image_validation="required|mimes:jpeg,jpg,png";
        }
        $request->validate([
            'name'=>'required',
            'image'=>$image_validation,
            'slug'=>'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*'=>'mimes:jpeg,jpg,png',
            'images.*'=>'mimes:jpeg,jpg,png',
        ]);
        $paid=$request->post('paid');
        $sku=$request->post('sku');
        $mrp=$request->post('mrp');
        $price=$request->post('price');
        $quantity=$request->post('quantity');
        $size_id=$request->post('size_id');
        $color_id=$request->post('color_id');

        foreach($sku as $key=>$val){
            $check=DB::table('products_attribute')->where('sku','=',$sku[$key])->where('id','!=', $paid[$key])->get();
            if(isset($check[0])){
                $request->session()->flash('sku_error',$sku[$key].'  SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

        if($request->post('id')>0){
            $model=Product::find($request->post('id'));
            $msg="product updated";

        }else{
            $model=new Product();
            $msg="product inserted";
        }

        if($request->hasFile('image')){
            $image=$request->File('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        $model->category_id=$request->post('category_id');
        $model->name=$request->post('name');
        $model->slug=$request->post('slug');
        $model->brand=$request->post('brand');
        $model->model=$request->post('model');
        $model->short_desc=$request->post('short_desc');
        $model->desc=$request->post('desc');
        $model->keywords=$request->post('keywords');
        $model->technical_specification=$request->post('technical_specification');
        $model->uses=$request->post('uses');
        $model->warranty=$request->post('warranty');
        $model->lead_time=$request->post('lead_time');
        $model->tax=$request->post('tax');
        $model->tax_type=$request->post('tax_type');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');
        $model->status=1;
        $model->save();
        $pid=$model->id;

        /*Product Attr Start */
        foreach($sku as $key=>$val){
            $products_attributeArr['product_id']=$pid;
            $products_attributeArr['sku']=$sku[$key];
            $products_attributeArr['mrp']=(int)$mrp[$key];
            $products_attributeArr['price']=(int)$price[$key];
            $products_attributeArr['quantity']=(int)$quantity[$key];
            if($size_id[$key]==''){
            $products_attributeArr['size_id']= 0;
            }else{
            $products_attributeArr['size_id']= $size_id[$key];
            }
            if($color_id[$key]==''){
            $products_attributeArr['color_id']=0;
            }else{
            $products_attributeArr['color_id']=$color_id[$key];
            }

            if($request->hasFile("attr_image.$key")){
                $rand=rand('111111111','999999999');
                $attr_image=$request->File("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->File("attr_image.$key")->storeAs('/public/media',$image_name);
                $products_attributeArr['attr_image']=$image_name;
            }else{
                $products_attributeArr['attr_image']='';
            }
            if($paid[$key]!=''){
                DB::table('products_attribute')->where(['id'=>$paid[$key]])->update($products_attributeArr);
            }else{
                DB::table('products_attribute')->insert($products_attributeArr);
            }

        }

        /*Product Attr End */


        /*product Images start */
        $piidArr=$request->post('piid');
        foreach($piidArr as $key=>$val){
            $product_ImagesArr['product_id']=$pid;
            if($request->hasFile("images.$key")){
                $rand=rand('111111111','999999999');
                $images=$request->File("images.$key");
                $ext=$images->extension();
                $image_name=$rand.'.'.$ext;
                $request->File("images.$key")->storeAs('/public/media',$image_name);
                $product_ImagesArr['images']=$image_name;

                if($piidArr[$key]!=''){
                DB::table('products_image')->where(['id'=>$piidArr[$key]])->update($product_ImagesArr);
                }else{
                    DB::table('products_image')->insert($product_ImagesArr);
                }
            }
        }

        /*product Images End */
        $request->session()->flash('message',$msg);
        return redirect('admin/product');
    }

    public function status(Request $request,$status,$id){
        $model=Product::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','product status updated');
        return redirect('admin/product');
    }

    public function delete(Request $request,$id){
        $model=Product::find($id);
        $model->delete();
        $request->session()->flash('message','product deleted');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request,$paid,$pid){
       DB::table('products_attribute')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }

    public function product_images_delete(Request $request,$paid,$pid){
        DB::table('products_image')->where(['id'=>$paid])->delete();
         return redirect('admin/product/manage_product/'.$pid);
     }


}
