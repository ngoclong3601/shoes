@extends('admin')
@section('content')
<div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create Product</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="name" placeholder="Product Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="price" placeholder="Price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="quantity" placeholder="The Number Of Import">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="prkeyword" placeholder="Key Word">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select style="height:50px !important; border-radius: 10rem !important;" name="category" id="category" class="form-control">
                                            <option selected disabled>Choose Category</option>
                                            <option value="1">NIKE</option>
                                            <option value="2">CONVERSES</option>
                                            <option value="3">ADDIDAS</option>
                                            <option value="4">VANS</option>
                                            <option value="5">NEW BALANCE</option>
                                            <option value="6">BALANCIAGA</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <fieldset  >
                                            <label for="">Choose Size</label><br>
                                            <input type="checkbox" name="size[]" value="39"> Size 39 
                                            <input type="checkbox" name="size[]" value="39"> Size 40
                                            <input type="checkbox" name="size[]" value="39"> Size 41
                                            <input type="checkbox" name="size[]" value="39"> Size 42
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 ">
                                        <label for="img">Choose Picture:</label>
                                        <input type="file" name="img">
                                    </div>
                                    <div class="col-sm-6">
                                  
                                    </div>
                                </div>
                                <a href="login.html" class="btn btn-primary btn-user btn-block">
                                    Add Product
                                </a>
                                <hr>
                               
                            </form>
                        </div>
                    </div>
@endsection