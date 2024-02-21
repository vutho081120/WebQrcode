@extends('Qrcode.layouts.MasterLayout')

@section('title')
    <title>Quản lý sản phẩm</title>
@endsection

@section('content')
    <!-- Chen trang them qrcode truy xuat -->
    <div class="productCreate">
        <div class="productCreateFrame">
            <!-- Trang them qrcode -->
            <div class="head">
                <h2> Thêm sản phẩm </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{route('qrcode.product.productListCreate')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Chọn lô hàng <span style="color: red">(*)</span> </label>
                            <select class="form-control" name="batch_id">
                                @if (isset($batchList) && count($batchList) > 0)
                                    @foreach ($batchList as $value)
                                        <option value="{{$value->id}}">{{$value->batch_code}}</option>
                                    @endforeach
                                @else
                                    <option value="Chưa có lô hàng nào">Chưa có lô hàng nào</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Mã danh sách sản phẩm <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" name="product_list_code" id="" placeholder="Nhập mã danh sách sản phẩm">
                        </div>
                        @if ($errors->has('product_list_code'))
                            <span style="color: red"> {{ $errors->first('product_list_code') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Tên danh sách sản phẩm <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" min="1" name="product_list_name" id="" placeholder="Nhập tên sản phẩm">
                        </div>
                        @if ($errors->has('product_list_name'))
                            <span style="color: red"> {{ $errors->first('product_list_name') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Số lượng <span style="color: red">(*)</span> </label>
                            <input type="number" class="form-control" min="1" name="quantity" id="" placeholder="Nhập số lượng sản phẩm">
                        </div>
                        @if ($errors->has('quantity'))
                            <span style="color: red"> {{ $errors->first('quantity') }} </span>
                        @endif

                        {{-- <div class=" form-group">
                            <div class="form-group d-flex">
                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>S:</span><input type="number" class="form-control" min="0" value="0" name="quantity_s" placeholder="S" style="width:70px">
                                </div>

                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>M:</span><input type="number" class="form-control" min="0" value="0" name="quantity_m" placeholder="M" style="width:70px">
                                </div>
                                
                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>L:</span><input type="number" class="form-control" min="0" value="0" name="quantity_l" placeholder="L" style="width:70px">
                                </div>

                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>XL:</span><input type="number" class="form-control" min="0" value="0" name="quantity_xl" placeholder="XL" style="width:70px">
                                </div>

                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>XXL:</span><input type="number" class="form-control" min="0" value="0" name="quantity_xxl" placeholder="XXL" style="width:70px">
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label> Chất liệu <span style="color: red">(*)</span> </label>
                            <select class="form-control" name="material">
                                <option value="Cotton"> Cotton </option>
                                <option value="Vải thô"> Vải thô </option>
                                <option value="Vải lụa"> Vải lụa </option>
                                <option value="Vải tuysi"> Vải tuysi </option>
                                <option value="Da thật"> Da thật </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Mô tả sản phẩm </label>
                            <textarea class="form-control" placeholder="Nhập mô tả sản phẩm" name="description" rows="3"></textarea>
                        </div>
                        @if ($errors->has('description'))
                            <span style="color: red"> {{ $errors->first('description') }} </span>
                        @endif

                        <div class="form-group">
                            <label for="product_list_img"> Ảnh <span style="color: red">(*)</span> </label> <br>
                            <input type="file" class="form-contol-file" name="product_list_img">
                        </div>
                        @if ($errors->has('product_list_img'))
                            <span style="color: red"> {{ $errors->first('product_list_img') }} </span>
                        @endif

                        <div class="form-group d-flex justify-content-between">
                            <a href="{{route('qrcode.product.productListShow')}}"  class="btn btn-primary" role="button">Huỷ</a>
                            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection