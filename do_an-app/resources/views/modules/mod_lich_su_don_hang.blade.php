<div class="container">
    <div class="women-product">
        <div class="table-head is-flex">
            <div class="table-head__item" style="width: 285px;">Mã đơn hàng</div>
            <div class="table-head__item" style="width: 170px;">Trạng thái</div>
            <div class="table-head__item" style="width: 185px;">Tổng tiền</div>
        </div>
        <div class="table-content">
            <div class="block-order-item-desk">
                @foreach($don_hang as $dh)
                <div class="order-item is-flex is-align-items-center">
                    <div class="order-item__product is-flex">
                        <div class="order__id">
                            <div class="info__title">
                                {{$dh->ma_don_hang}}
                            </div>
                        </div>
                    </div>
                    <div class="order-item__status">
                        <div class="status">{{$dh->ten_trang_thai}}</div>
                    </div>
                    <div class="order-item__price">
                        <div class="price">{{$dh->tong_tien}}</div>
                    </div>
                    <div class="order-item__btn-view">
                        <a href="/chi-tiet/id_dh={{$dh->ID}}"> Xem chi tiết
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('modules.mod_info_acc')
</div>