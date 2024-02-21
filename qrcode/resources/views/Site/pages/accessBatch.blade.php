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
                <h2> Truy xuất lô hàng </h2>
            </div>
            <div class="body">
                <table class="table table-hover">
                    <tbody>
                        <tr class="table-row">
                            <td>
                               Mã lô hàng
                            </td>
                            <td>
                                {{ $batchItem->batch_code }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Tên lô hàng
                            </td>
                            <td>
                                {{ $batchItem->batch_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Năm sản xuất
                            </td>
                            <td>
                                {{ $batchItem->year_create }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sản xuất tại
                            </td>
                            <td>
                                {{ $batchItem->made_in }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Mô tả lô hàng
                            </td>
                            <td>
                                {{ $batchItem->description }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số lượng danh sách sản phẩm
                            </td>
                            <td>
                                {{ $batchItem->quantity_product_list }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Số lượng sản phẩm
                            </td>
                            <td>
                                {{ $batchItem->quantity_product }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection