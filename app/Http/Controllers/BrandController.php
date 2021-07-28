<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $result['data']=Brand::all();
       return view('admin/brand',$result);
    }


    public function manage_brand(Request $request,$id='')
    {
        if($id>0){
            $arr=Brand::where(['id'=>$id])->get();

            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['id']=$arr['0']->id;
        }else{

            $result['name']='';
            $result['image']='';
            $result['id']=0;
        }
        return view('admin/manage_brand',$result);
    }

    public function manage_brand_process(Request $request)
    {
        $request->validate([

            'name'=>'required|unique:brands,name,'.$request->post('id'),
            'image'=>'mimes:jpeg,jpg,png'
        ]);


        if($request->post('id')>0){
            $model=Brand::find($request->post('id'));
            $msg="Brand updated";

        }else{
            $model=new Brand();
            $msg="Brand inserted";
        }

        if($request->hasFile('image')){
            $image=$request->File('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/brand/',$image_name);
            $model->image=$image_name;
        }
        $model->name=$request->post('name');
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/brand');
    }

    public function status(Request $request,$status,$id){
        $model=Brand::find($id);
        $model->status=$status;
        $model->save();
        $request->session()->flash('message','brand status updated');
        return redirect('admin/brand');
    }

    public function delete(Request $request,$id){
        $model=Brand::find($id);
        $model->delete();
        $request->session()->flash('message','brand deleted');
        return redirect('admin/brand');
    }
}
