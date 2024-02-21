@extends('Site.layouts.MasterLayout')

@section('title')
    <title>Danh sách sản phẩm</title>
@endsection

@section('content')
    <!-- Category -->
    <div class="home">
        <!-- Chen category -->
        <div class="homeFrame">
            <!-- Chen trang danh sach -->
            {{-- <div class="filterFrame">
                @include("Site.components.filter")
            </div> --}}

            <!-- Chen trang danh sach -->
            <div class="productListFrame">
                @include("Site.components.productList")
            </div>
        </div>
    </div>
@endsection
