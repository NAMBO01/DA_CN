<div class="container">
    <div class="women-product">
        <div class="navbar-container is-flex is-align-items-center">
            <div>
                <div class="icon-pn">
                    <a href="/back"><i class="fa-solid fa-left-long"></i></a> Chi Tiết Đơn Hàng
                </div>
            </div>
            <div class="pn-container">
                @if(isset($ct_don_hang))
                @foreach($ct_don_hang as $ct_dh)
                <div class="block-order-detail">
                    <div class="order-detail__code">
                        <p class="code-name">
                            Mã đơn hàng {{$ct_dh->ma_don_hang}}-{{$ct_dh->ten_trang_thai}}
                        </p>
                        <p class="code_time"></p>
                    </div>
                </div>
                @endforeach
                @endif
                
            </div>
        </div>
    </div>
    @include('modules.mod_info_acc')
    <div class="clearfix"> </div>
</div>