<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
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

              $employeelist= Employee::where(DB::raw('LOWER(name)'), 'LIKE', "%".$searchtext."%")->paginate(6);
        }
       else       $employeelist = Employee::paginate(6);

       return view('admin.employee.index')->with(array('employeelist'=>$employeelist));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
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
            'profession'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
    if(isset($request->empid)) {
        $employee = Employee::find($request->empid);

    }
      else  $employee = new Employee();
if(isset($request->image)) {
    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    $request->image->move(public_path('images/employees'), $imageName);
    $image=new Image();
    $image->url = $imageName;
    $image->save();
    $employee->image_id=$image->id;}


// save image to database

        $employee->name = $request->name;
        $employee->profession = $request->profession;

        $employee->save();
        return redirect()->action('EmployeeController@index');
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
        $employee = Employee::where('id', $id)->first();

        return view('admin.employee.edit',array('employee'=>$employee));
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
        $employee = Employee::find($id);

        $employee->delete();
        //files and images of store should be deleted
        return redirect()->action('EmployeeController@index');
    }
}
