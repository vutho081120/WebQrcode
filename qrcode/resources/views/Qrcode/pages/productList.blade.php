@extends('Qrcode.layouts.MasterLayout')

@section('title')
    <title> Danh sách sản phẩm </title>
@endsection

@section('content')
    <!-- Chen trang thong tin QRCode truy xuất -->
    <div class="productInfo">
        <div class="productInfoFrame">
            <!-- Trang thong tin QRCode -->
            <form action="{{route('qrcode.product.productListDelete')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="head d-flex justify-content-between">
                    <h2> Danh sách sản phẩm </h2>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Xoá</button>
                        <a href="{{route('qrcode.product.productListCreateShow')}}"  class="btn btn-primary" role="button" style="margin-left: 16px">Thêm</a>
                    </div>
                </div>
                <div class="body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Chọn</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Mã lô hàng</th>
                                <th scope="col">Mã danh sách sản phẩm</th>
                                <th scope="col">Tên danh sách sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col" colspan="4">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productListAll as $key => $value)   
                                <tr class="table-row">
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input position-static" type="checkbox" name="delete[]" value="{{$value->id}}">
                                        </div>
                                    </td>
                                    <td style="width: 110px;">
                                        <img src="{{ asset('images/product/'.$value->product_list_img.'') }}" class="img-fluid img-thumbnail" alt="">
                                    </td>
                                    <td>
                                        {{ $value->batch_code }}
                                    </td>
                                    <td>
                                        {{ $value->product_list_code }}
                                    </td>
                                    <td class="w-25">
                                        {{ $value->product_list_name }}
                                    </td>
                                    <td>
                                        {{ $value->quantity }}
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.product.productListDetail', $value->id)}}"><i class="fas fa-info"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.product.productListUpdateShow', $value->id)}}"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.product.createAccessWord', $value->id)}}" class="btn btn-primary" role="button">Tạo QR truy xuất</a>
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.product.createVerifyWord', $value->id)}}" class="btn btn-primary" role="button">Tạo QR xác minh</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="page">
                    @if (isset($productListAll) && count($productListAll) > 0)
                        {{ $productListAll->links() }}
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection