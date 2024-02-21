<div class="filter">
    <form action="{{route('site.home.find')}}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="filterSelect form-group d-flex align-items-center">
            <label> Năm sản xuất </label>
            <select class="form-control" name="year_create" class="year_create">
                <option value="0">Mặc định</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2028">2018</option>
            </select>

            <label style="padding-left: 68px"> Quốc Gia </label>
            <select class="form-control" name="made_in" class="made_in">
                <option value="0">Mặc dịnh</option>
                <option value="Việt Nam">Việt Nam</option>
                <option value="Trung Quốc">Trung Quốc</option>
                <option value="Thái Lan">Thái Lan</option>
            </select>

            <button class="btn btn-primary" type="submit">Lọc</button>
        </div>
    </form>
</div>