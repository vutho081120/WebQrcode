<!-- Danh sach -->

<div class="productList">

    {{-- <div class="top">

        <div class="title">
            <h1> 
                {{ $loaiSanPham->category_name }}
            </h1>
        </div>
    </div> --}}

    <div class="listItem">
        @if (isset($productListAll) && count($productListAll) > 0)
            @foreach ($productListAll as $key => $value )
                <a href="">
                    <div class='item'>
                        <div class='productImg'>
                            <img src="{{ asset('images/product/'.$value->product_list_img) }}" alt="">
                        </div>
                        <div class='productContent'>
                            <div class='itemTop'>
                                <p class='codeTitle'> {{ $value->product_list_name }} </p>
                                <span class='price'> <img src="{{ asset('images/QrcodeProduct/product-'.$value->product_list_code.'/access/'.$value->product_qrcode_access_img) }}" alt=""> </span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach  
        @else
            <div>
                <h2 style="padding-left: 16px"> Chưa có sản phẩm </h2>
            </div>
        @endif
    </div>
</div>