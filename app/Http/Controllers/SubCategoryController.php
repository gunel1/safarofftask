<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $childCategory = Category::where('parent_id','!=', null)->get();

        return view('admin.subcategory.index')->withCategories($childCategory);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories']);
        if(isset($request->categoryid)) {
            $category = Category::find($request->categoryid);

        }
        else  $category = new Category();

        $category->name = $request->name;
        $category->parent_id=$request->parent;
        $category->save();
        return redirect()->action('SubCategoryController@index');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();


        return view('admin.subcategory.edit',array('category'=>$category));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        return redirect()->action('SubCategoryController@index');
    }
}
