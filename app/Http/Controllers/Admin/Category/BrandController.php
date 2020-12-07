<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use App\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $brands = Brand::all();
        return view('admin.auth.category.brand', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
           'brand_name'=> 'required|unique:brands',
           'brand_logo'=> 'required'
        ]);
        if ($request->hasFile('brand_logo')) {
            $image = $request->file('brand_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/brand');
            $image->move($destinationPath, $name);

        }
        $brand= new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_logo = '/uploads/brand/'.$name;
        $brand->save();

        return redirect()->back()->with(['message'=>'Brand is added successfully', 'alert-type'=>'success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $brand = Brand::find($id);
        return view('admin.auth.category.edit_brand', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $old_logo = $request->old_logo;
        $request->validate([
           'brand_name' => 'required',

        ]);
        $brand->brand_name = $request->brand_name;

        if ($request->hasFile('brand_logo')) {

            // at first we will unlink the exiusting image from the directory
            $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
            $file_delete =  "$base_dir/$old_logo";
            if (file_exists($file_delete)) {
                unlink($file_delete);
            }

            //The new image will be uploaded to uploads directory
            $image = $request->file('brand_logo');
            $name = time().'.'.$image->getClientOriginalName();
            $destinationPath = public_path('/uploads/brand');
            $image->move($destinationPath, $name);


            $brand->brand_logo = '/uploads/brand/'.$name;
            $brand->save();
            return redirect()->route('brands.index')->with(['message'=>'Brand is updated successfully with logo' , 'alert-type'=>'success']);

        }else{
            $brand->save();
            return redirect()->route('brands.index')->with(['message'=>'Brand is upfated successfully without logo', 'alert-type'=>'success']);

        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $brand = Brand::findOrFail($id);

        $file_name = $brand->brand_logo ;
        $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
        $file_delete =  "$base_dir/$file_name";
        if (file_exists($file_delete)) {
            unlink($file_delete);
        }

        $brand->delete();
        return redirect()->back()->with(['message'=>'Brand is deleted successfully','alert-type'=>'success']);

    }
}
