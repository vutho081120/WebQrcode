@extends('Qrcode.layouts.MasterLayout')

@section('title')
    <title> Chi tiết sản phẩm </title>
@endsection

@section('content')
    <!-- Chen trang thong tin QRCode truy xuất -->
    <div class="productDetail">
        <div class="productDetailFrame">
            <!-- Trang thong tin QRCode -->
            <div class="head d-flex justify-content-between">
                <h2> Chi tiết sản phẩm </h2>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <tbody>
                        <tr class="table-row">
                            <td>
                               Ảnh
                            </td>
                            <td>
                                <div style="width: 200px;">
                                    <img src="{{ asset('images/product/'.$productListItem->product_list_img.'') }}" class="img-fluid img-thumbnail" alt="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mã lô hàng
                             </td>
                             <td>
                                 {{ $productListItem->batch_code }}
                             </td>
                        </tr>
                        <tr>
                            <td>
                                Mã sản phẩm
                            </td>
                            <td>
                                {{ $productListItem->product_list_code }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tên sản phẩm
                            </td>
                            <td>
                                {{ $productListItem->product_list_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số lượng
                            </td>
                            <td>
                                {{ $productListItem->quantity }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                
                            </td>
                            <td>
                                S: {{ $productListItem->quantity_s }} &nbsp; M: {{ $productListItem->quantity_m }} &nbsp; L: {{ $productListItem->quantity_l }} &nbsp;
                                XL: {{ $productListItem->quantity_xl }} &nbsp; XXL: {{ $productListItem->quantity_xxl }}
                            </td>
                        </tr> --}}
                        <tr>
                            <td>
                               Chất liệu
                            </td>
                            <td>
                                {{ $productListItem->material }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mô tả sản phẩm
                            </td>
                            <td>
                                {{ $productListItem->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection