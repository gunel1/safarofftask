<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Image;
use Illuminate\Http\Request;
use App\Ourwork;
use Illuminate\Support\Facades\DB;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->searchtext)) {
            $searchtext = strtolower($request->searchtext);

            $blogs= Blog::where(DB::raw('LOWER(name)'), 'LIKE', "%".$searchtext."%")->paginate(6);
        }
        else       $blogs = Blog::paginate(6);

        return view('admin.blog.index')->with(array('blogs'=>$blogs));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'title' => 'required',
            'text'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        if(isset($request->blogid)) {
            $blog = Blog::find($request->blogid);

        }
        else  $blog = new Blog();
        if(isset($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/blogs'), $imageName);
            $image=new Image();
            $image->url = $imageName;
            $image->save();
            $blog->image_id=$image->id;}


// save image to database

        $blog->title = $request->title;
        $blog->text = $request->text;
        if(is_int($request->parent))
        $blog->category_id = $request->parent;
        if(is_int($request->child))
        $blog->category_id = $request->child;

        $blog->save();
        return redirect()->action('BlogController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendChildCategory(Request $request)
    {

        $parentId= $request->input('id');

            $childCategory=Category::all()->where('parent_id',$parentId) ;


        return response()->json(array('childCategory' => $childCategory), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();


        return view('admin.blog.edit',array('blog'=>$blog));
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
        $blog = Blog::find($id);

        $blog->delete();
        //files and images of store should be deleted
        return redirect()->action('BlogController@index');
    }
}
