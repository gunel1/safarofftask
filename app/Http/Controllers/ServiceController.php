<?php

namespace App\Http\Controllers;

use App\Image;
use App\Service;
use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;
class ServiceController extends Controller
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

            $services= Service::where(DB::raw('LOWER(name)'), 'LIKE', "%".$searchtext."%")->paginate(6);
        }
        else       $services = Service::paginate(6);

        return view('admin.service.index')->with(array('services'=>$services));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        if(isset($request->serviceid)) {
            $service = Service::find($request->serviceid);

        }
        else  $service = new Service();

        // save image to database

        if(isset($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/services'), $imageName);
            $image=new Image();
            $image->url = $imageName;
            $image->save();
            $service->image_id=$image->id;}



        $service->name = $request->name;
        $service->description = $request->description;

        $service->save();
        return redirect()->action('ServiceController@index');
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
        $service = Service::where('id', $id)->first();

        return view('admin.service.edit',array('service'=>$service));
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
        $service = Service::find($id);

        $service->delete();
        //files and images of store should be deleted
        return redirect()->action('ServiceController@index');
    }
}
