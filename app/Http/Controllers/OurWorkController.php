<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Ourwork;
use Illuminate\Support\Facades\DB;
class OurWorkController extends Controller
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

            $ourworks= Ourwork::where(DB::raw('LOWER(name)'), 'LIKE', "%".$searchtext."%")->paginate(6);
        }
        else       $ourworks = Ourwork::paginate(6);

        return view('admin.ourwork.index')->with(array('ourworks'=>$ourworks));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ourwork.create');
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
            'name' => 'required',
            'description'=>'required',
            'category'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        if(isset($request->ourworkid)) {
            $ourwork = Ourwork::find($request->ourworkid);

        }
        else  $ourwork = new Ourwork();
        if(isset($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/ourworks'), $imageName);
            $image=new Image();
            $image->url = $imageName;
            $image->save();
            $ourwork->image_id=$image->id;}


// save image to database

        $ourwork->name = $request->name;
        $ourwork->description = $request->description;
        if(is_int($request->category))
        $ourwork->category_id = $request->category;
        $ourwork->website = $request->website;

        $ourwork->save();
        return redirect()->action('OurWorkController@index');
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
        $ourwork = Ourwork::where('id', $id)->first();

        return view('admin.ourwork.edit',array('ourwork'=>$ourwork));
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
        $ourwork = Ourwork::find($id);

        $ourwork->delete();
        //files and images of store should be deleted
        return redirect()->action('OurWorkController@index');
    }
}
