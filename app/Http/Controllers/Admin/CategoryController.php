<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryFormRequest;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request){

        $data=$request->validated();

        $category=new Category;

        $category->name=$data['name'];
        $category->slug=Str::slug($data['slug']);
        $category->description=$data['description'];

        if($request->hasfile('image')){
             $file=$request->file('image');
             $filename=time().'.'.$file->getClientOriginalExtension();
             $file->move('uploads/category/',$filename);
             $category->image=$filename;
        }
        $category->meta_title=$data['meta_title'];
        $category->meta_description=$data['meta_description'];
        $category->meta_keyword=$data['meta_keyword'];

        $category->navbar_status=$request->navbar_status == true ? 1 : 0;
        // $category->navbar_status=$data['navbar_status'];
        // $category->status=$data['status'];
        $category->status=$request->status == true ? 1 : 0;
        $category->created_by=Auth::user()->id;

        $category->save();

        return redirect(route('admin.category'))->with('status','Category Added Successfully');
        // Category::create([
        //     'name'=>$request->name,
        //     'slug'=>$request->slug,
        //     'description'=>$request->description,
        //     'image'=>$request->image,
        //     'meta_title'=>$request->meta_title,
        //     'meta_description'=>$request->meta_description,
        //     'meta_keyword'=>$request->meta_keyword,
        //     'navbar_status'=>$request->navbar_status,
        //     'status'=>$request->status,

        // ]);
        // return back();
    }

    public function edit($category_id){
        $category=Category::findOrFail($category_id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(CategoryFormRequest $request,$category_id){
          
        $data=$request->validated();

        $category=Category::findOrFail($category_id);

        $category->name=$data['name'];
        $category->slug=Str::slug($data['slug']);
        $category->description=$data['description'];

        if($request->hasfile('image')){

            $destination ='uploads/category/'.$category->image;
            if(File::exists($destination)){
                 File::delete($destination);
            }

             $file=$request->file('image');
             $filename=time().'.'.$file->getClientOriginalExtension();
             $file->move('uploads/category/',$filename);
             $category->image=$filename;
        }
        $category->meta_title=$data['meta_title'];
        $category->meta_description=$data['meta_description'];
        $category->meta_keyword=$data['meta_keyword'];

        $category->navbar_status=$request->navbar_status == true ? 1 : 0;
        // $category->navbar_status=$data['navbar_status'];
        // $category->status=$data['status'];
        $category->status=$request->status == true ? 1 : 0;
        $category->created_by=Auth::user()->id;

        $category->update();

        return redirect(route('admin.category'))->with('status','Category Updated Successfully');

    }

    public function delete($category_id){
         
        $category=Category::findOrFail($category_id);

        if($category){
            $destination ='uploads/category/'.$category->image;
            if(File::exists($destination)){
                 File::delete($destination);
            }
            $category->delete();
            return redirect(route('admin.category'))->with('status','Category Deleted Successfully');
        }
        else{
            return redirect(route('admin.category'))->with('status','Category ID Not Found');
        }
    }
}
