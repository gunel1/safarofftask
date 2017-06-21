@extends('admin.master')

@section('main_content')
    <section class="content-header">

        <div class="container" style="height: 100%;width: 100%;">
            <div class="" >
                <div class="item  " style="margin-top: 1%; box-shadow: 1px 1px 1px black;">
                    <div class="thumbnail" style="margin-top: 1%">
                        <h1 style="margin-left: 5%">ADD NEW Blog </h1>
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
                                    <form class="form-horizontal form-label-left" novalidate style="margin-top: 5%; width:90%;margin-left: 5%;" action="{{ URL::to('/admin/blog/') }}" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title"> Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="title" class="form-control col-md-7 col-xs-12"  name="title" required="required" type="text">
                                            </div>
                                        </div>


                                        <div class="item form-group" >
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="text"> Text <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="text" class="form-control col-md-7 col-xs-12"  name="text" required="required" type="text">
                                            </div>
                                        </div>

                                        <div class="form-group" >
                                            <div class="col-md-6 col-md-offset-3">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent"> Parent category
                                                </label>
                                                <?php $categories=\App\Category::where('parent_id',null)->get();?>
                                                <select  name="parent" id="parent" onchange="getChildren(this)">
                                                    <option value="Choose one">Choose one</option>
                                                    @foreach ($categories as $category) {

                                                    <option    value="{{$category->id}}">{{ $category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="subcategory" hidden>
                                            <div class="col-md-6 col-md-offset-3" >
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="child"> Sub Category
                                                </label>
                                                <select  name="child" id="child">
                                                    <option value="Choose one">Choose one</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">

                                                <input type="file" name="image" class="btn btn-file">
                                                <br>                                     
                                                <br>
                                                <button type="button" class="btn btn-primary" onclick="redirect()">Cancel</button>
                                                <input type="submit" class="btn btn-success" value="Create" >
                                            </div>
                                        </div>
                                    </form>
            <!-- /page content -->
                </div>
              </div>
             </div>
            </div>

        <script>
            function getChildren(selectObject){
                var value = selectObject.value;
                $.ajax({
                    type:'GET',
                    url: "{{URL::to('/admin/blog/category')}}",
                    data: {id: value},
                    success:function(data){
                        $('#child').empty();
                        $('#subcategory').hide();
                        $.each(data.childCategory, function (key, value) {
                            $('#subcategory').show();
                            $('#child').append($('<option>', {
                                value:value['id']  ,
                                text: value['name']
                            }));
                        })
                    },
                    error: function( jqXhr, textStatus, errorThrown ){
                        alert($(this).val()+'failure');
                    }
                });
            }

            function redirect(){
                window.location="{{URL::to('/admin/blog')}}";
            }
        </script>

        <!-- ./wrapper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    </section>
@stop
