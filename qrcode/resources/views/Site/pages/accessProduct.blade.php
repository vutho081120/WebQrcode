@extends('Site.layouts.MasterLayout')

@section('title')
    <title> Thông tin QRCode truy xuất </title>
@endsection

@section('content')
    <!-- Chen trang thong tin QRCode truy xuất -->
    <div class="show">
        <div class="showFrame">
            <!-- Trang thong tin QRCode -->
            <div class="head d-flex justify-content-between">
                <h2> Truy xuất sản phẩm </h2>
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
                                    <img src="{{ asset('images/product/'.$producListItem->product_list_img.'') }}" class="img-fluid img-thumbnail" alt="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mã lô hàng
                             </td>
                             <td>
                                 {{ $producListItem->batch_code }}
                             </td>
                        </tr>
                        <tr>
                            <td>
                                Mã sản phẩm
                            </td>
                            <td>
                                {{ $producListItem->product_list_code }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tên sản phẩm
                            </td>
                            <td>
                                {{ $producListItem->product_list_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số lượng
                            </td>
                            <td>
                                {{ $producListItem->quantity }}
                            </td>
                        </tr>
                        {{-- <tr>
                            <td>
                                
                            </td>
                            <td>
                                S: {{ $producListItem->quantity_s }} &nbsp; M: {{ $producListItem->quantity_m }} &nbsp; L: {{ $producListItem->quantity_l }} &nbsp;
                                XL: {{ $producListItem->quantity_xl }} &nbsp; XXL: {{ $producListItem->quantity_xxl }}
                            </td>
                        </tr> --}}
                        <tr>
                            <td>
                               Chất liệu
                            </td>
                            <td>
                                {{ $producListItem->material }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mô tả sản phẩm
                            </td>
                            <td>
                                {{ $producListItem->description }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection