<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //
        $subcategories = Subcategory::all();
        $categories = Category::all();
        return view('admin.auth.category.subcategory',compact('subcategories','categories'));

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
            'subcategory_name'=>'required| unique:subcategories',
            'category_id' =>'required',
        ]);

        $subcat = new Subcategory();
        $subcat->category_id = $request->category_id;
        $subcat->subcategory_name = $request->subcategory_name;

        $subcat->save();
        return redirect()->back()->with(['message'=>'Subcategory is added', 'alert-type'=>'success']);
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
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('admin.auth.category.edit_subcategory', compact('subcategory','categories'));

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
        //
        $request->validate([
            'subcategory_name' =>'required'
        ]);
        $subcat = Subcategory::find($id);
        $subcat->subcategory_name = $request->subcategory_name;
        $subcat->category_id = $request->category_id;
        $subcat->save();
        return redirect()->route('subcategories.index')->with(['message'=>'Subcategory is updated', 'alert-type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subcategory::find($id)->delete();
        return redirect()->back()->with(['message'=>'Subcategory i9s deleted','alert-type'=>'success']);
    }
}
