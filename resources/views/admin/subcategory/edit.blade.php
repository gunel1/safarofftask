@extends('admin.master')

@section('main_content')
    <section class="content-header">

        <div class="container" style="height: 100%;width: 100%;">
            <div class="" >
                <div class="item  " style="margin-top: 1%; box-shadow: 1px 1px 1px black;">
                    <div class="thumbnail" style="margin-top: 1%">
                        <h1 style="margin-left: 5%">Edit  Category </h1>
                        <hr>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal form-label-left" novalidate style="margin-top: 5%; width:90%;margin-left: 5%;" action="{{ URL::to('/admin/subcategory/') }}" method="post">

                            <div class="form-group" >
                                <div class="col-md-6 col-md-offset-3">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent"> Parent category
                                    </label>
                                    <?php $categories=\App\Category::where('parent_id',null)->get();?>
                                    <select  name="parent" id="parent" >
                                        <option value="{{$category->parentCategory->id}}">{{$category->parentCategory->name}}</option>
                                        @foreach ($categories as $category) {

                                        <option    value="{{$category->id}}">{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="item form-group" >
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Sub Category <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12"  name="name" required="required" value="{{$category->name}}" type="text">
                                </div>
                            </div>
                            <input name="categoryid" type="hidden" value="{{$category->id}}" >
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <br>
                                    <br>
                                    <button type="button" class="btn btn-primary" onclick="redirect()">Cancel</button>
                                    <input type="submit" class="btn btn-success" value="Save" >
                                </div>
                            </div>
                        </form>
                        <!-- /page content -->
                    </div>
                </div>
            </div>
        </div>

        <script>
            function redirect(){
                window.location="{{URL::to('/admin/subcategory')}}";
            }
        </script>

    </section>
@stop
