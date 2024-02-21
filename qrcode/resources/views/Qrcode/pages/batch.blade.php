@extends('Qrcode.layouts.MasterLayout')

@section('title')
    <title> Danh sách lô hàng</title>
@endsection

@section('content')
    <!-- Chen trang thong tin QRCode truy xuất -->
    <div class="batchInfo">
        <div class="batchInfoFrame">
            <!-- Trang thong tin QRCode -->
            <form action="{{route('qrcode.batch.batchDelete')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="head">
                    <h2> Danh sách lô hàng </h2>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Xoá</button>
                        <a href="{{route('qrcode.batch.batchCreateShow')}}"  class="btn btn-primary" role="button" style="margin-left: 16px">Thêm</a>
                    </div>
                </div>
                <div class="body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Chọn</th>
                                <th scope="col">Mã lô hàng</th>
                                <th scope="col">Tên lô hàng</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Năm sản xuất</th>
                                <th scope="col" colspan="4">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batchList as $key => $value)   
                                <tr class="table-row">
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input position-static" type="checkbox" name="delete[]" value="{{$value->id}}">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $value->batch_code }}
                                    </td>
                                    <td>
                                        {{ $value->batch_name }}
                                    </td>
                                    <td>
                                        {{ $value->quantity_product }}
                                    </td>
                                    <td>
                                        {{ $value->year_create }}
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.batch.batchDetail', $value->id)}}"><i class="fas fa-info"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.batch.batchUpdateShow', $value->id)}}"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.batch.createAccessWord', $value->id)}}" class="btn btn-primary" role="button">Tạo QR truy xuất</a>
                                    </td>
                                    <td>
                                        <a href="{{route('qrcode.batch.createVerifyWord', $value->id)}}" class="btn btn-primary" role="button">Tạo QR xác minh</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="page">
                    @if (isset($batchList) && count($batchList) > 0)
                        {{ $batchList->links() }}
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection