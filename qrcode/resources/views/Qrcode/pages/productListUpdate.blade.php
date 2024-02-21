@extends('Qrcode.layouts.MasterLayout')

@section('title')
    <title>Sửa sản phẩm </title>
@endsection

@section('content')
    <!-- Chen trang them qrcode truy xuat -->
    <div class="productUpdate">
        <div class="productUpdateFrame">
            <!-- Trang them qrcode -->
            <div class="head">
                <h2> Sửa sản phẩm </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{route('qrcode.product.productListUpdate', $productListItem->id)}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Chọn lô hàng <span style="color: red">(*)</span> </label>
                            <select class="form-control" name="batch_id" readonly>
                                <option value="{{$productListItem->batch_id}}">{{$productListItem->batch_code}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Mã sản phẩm <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" name="product_list_code" id="" placeholder="Nhập mã sản phẩm" value="{{$productListItem->product_list_code}}" readonly>
                        </div>
                        @if ($errors->has('product_list_code'))
                            <span style="color: red"> {{ $errors->first('product_list_code') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Tên sản phẩm <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" min="1" name="product_list_name" id="" placeholder="Nhập tên sản phẩm" value="{{$productListItem->product_list_name}}">
                        </div>
                        @if ($errors->has('product_list_name'))
                            <span style="color: red"> {{ $errors->first('product_list_name') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Số lượng <span style="color: red">(*)</span> </label>
                            <input type="number" class="form-control" min="1" name="quantity" id="" placeholder="Nhập số lượng sản phẩm" value="{{$productListItem->quantity}}">
                        </div>
                        @if ($errors->has('quantity'))
                            <span style="color: red"> {{ $errors->first('quantity') }} </span>
                        @endif

                        {{-- <div class=" form-group">
                            <div class="form-group d-flex">
                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>S:</span><input type="number" class="form-control" min="0" name="quantity_s" placeholder="S" style="width:70px" value="{{$productListItem->quantity_s}}">
                                </div>

                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>M:</span><input type="number" class="form-control" min="0" name="quantity_m" placeholder="M" style="width:70px" value="{{$productListItem->quantity_m}}">
                                </div>
                                
                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>L:</span><input type="number" class="form-control" min="0" name="quantity_l" placeholder="L" style="width:70px" value="{{$productListItem->quantity_l}}">
                                </div>

                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>XL:</span><input type="number" class="form-control" min="0" name="quantity_xl" placeholder="XL" style="width:70px" value="{{$productListItem->quantity_xl}}">
                                </div>

                                <div class="form-group col-lg-2 d-flex align-items-center" style="max-width: 19.8%; width: 19.6%;">
                                    <span>XXL:</span><input type="number" class="form-control" min="0" name="quantity_xxl" placeholder="XXL" style="width:70px" value="{{$productListItem->quantity_xxl}}">
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label> Chất liệu <span style="color: red">(*)</span> </label>
                            <select class="form-control" name="material">
                                <option value="Cotton" @if ($productListItem->material == "Cotton") selected @endif> Cotton </option>
                                <option value="Vải thô" @if ($productListItem->material == "Vải thô") selected @endif> Vải thô </option>
                                <option value="Vải lụa" @if ($productListItem->material == "Vải lụa") selected @endif> Vải lụa </option>
                                <option value="Vải tuysi" @if ($productListItem->material == "Vải tuysi") selected @endif> Vải tuysi </option>
                                <option value="Da thật" @if ($productListItem->material == "Da thật") selected @endif> Da thật </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Mô tả sản phẩm </label>
                            <textarea class="form-control" placeholder="Nhập mô tả sản phẩm" name="describe" rows="3">{{$productListItem->describe}}</textarea>
                        </div>
                        @if ($errors->has('describe'))
                            <span style="color: red"> {{ $errors->first('describe') }} </span>
                        @endif

                        <div class="form-group">
                            <label for="product_list_img">Ảnh</label> <br>
                            <input type="file" class="form-contol-file" name="product_list_img">
                        </div>
                        @if ($errors->has('product_list_img'))
                            <span style="color: red"> {{ $errors->first('product_list_img') }} </span>
                        @endif

                        <div class="form-group d-flex justify-content-between">
                            <a href="{{route('qrcode.product.productListShow')}}"  class="btn btn-primary" role="button">Huỷ</a>
                            <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection