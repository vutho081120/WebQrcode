@extends('Site.layouts.MasterLayout')

@section('title')
    <title>Danh sách sản phẩm</title>
@endsection

@section('content')
    <!-- Category -->
    <div class="find">
        <!-- Chen category -->
        <div class="findFrame">
            <!-- Chen trang danh sach -->
            <div class="productListFrame">
                <div class="header" style="padding-top: 16px">
                    <h3>Kết quả lọc</h3>     
                </div>

                @include("Site.components.find")
            </div>
        </div>
    </div>
@endsection
