@extends('Qrcode.layouts.MasterLayout')

@section('title')
    <title>Quản lý lô hàng</title>
@endsection

@section('content')
    <!-- Chen trang them qrcode truy xuat -->
    <div class="batchCreate">
        <div class="batchCreateFrame">
            <!-- Trang them qrcode -->
            <div class="head">
                <h2> Thêm lô hàng </h2>
            </div>
            <div class="body">
                <div class="col-md-6">
                    <form action="{{route('qrcode.batch.batchCreate')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Mã lô hàng <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" name="batch_code" id="" placeholder="Nhập mã lô hàng">
                        </div>
                        @if ($errors->has('batch_code'))
                            <span style="color: red"> {{ $errors->first('batch_code') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Tên lô hàng <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" name="batch_name" id="" placeholder="Nhập tên lô hàng">
                        </div>
                        @if ($errors->has('batch_name'))
                            <span style="color: red"> {{ $errors->first('batch_name') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Năm sản xuất <span style="color: red">(*)</span> </label>
                            <input type="text" class="form-control" min="1" name="year_create" id="" placeholder="Nhập năm sản xuất">
                        </div>
                        @if ($errors->has('year_create'))
                            <span style="color: red"> {{ $errors->first('year_create') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Sản xuất tại <span style="color: red">(*)</span> </label>
                            <select class="form-control" name="made_in">
                                <option value="Việt Nam"> Việt Nam </option>
                                <option value="Trung Quốc"> Trung Quốc </option>
                                <option value="Thái Lan"> Thái Lan </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Mô tả lô hàng </label>
                            <input type="text" class="form-control" min="1" name="description" id="" placeholder="Nhập mô tả lô hàng">
                        </div>
                        @if ($errors->has('description'))
                            <span style="color: red"> {{ $errors->first('description') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Số lượng danh sách sản phẩm <span style="color: red">(*)</span> </label>
                            <input type="number" class="form-control" min="1" name="quantity_product_list" id="" placeholder="Nhập số lượng danh sách sản phẩm">
                        </div>
                        @if ($errors->has('quantity_product_list'))
                            <span style="color: red"> {{ $errors->first('quantity_product_list') }} </span>
                        @endif

                        <div class="form-group">
                            <label> Số lượng sản phẩm <span style="color: red">(*)</span> </label>
                            <input type="number" class="form-control" min="1" name="quantity_product" id="" placeholder="Nhập số lượng sản phẩm">
                        </div>
                        @if ($errors->has('quantity_product'))
                            <span style="color: red"> {{ $errors->first('quantity_product') }} </span>
                        @endif

                        <div class="form-group d-flex justify-content-between">
                            <a href="{{route('qrcode.batch.batchShow')}}"  class="btn btn-primary" role="button">Huỷ</a>
                            <button type="submit" class="btn btn-primary">Lưu lô hàng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection