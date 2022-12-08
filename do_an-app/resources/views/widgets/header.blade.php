<div class="header">
    <div class="top-header">
        <div class="container">
            <div class="top-header-left">
                <ul class="support">
                    <li><a href="#"><label> </label></a></li>
                    <li><a href="#">Tổng đài hỗ trợ<span class="live"> 24/7 </span></a></li>
                </ul>
                <ul class="support">
                    <li class="van"><a href="#"><label> </label></a></li>
                    <li><a href="#">Giao hàng miễn phí <span class="live">cho đơn đặt hàng trên 500 sản
                                phẩm</span></a></li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            {{-- <div class="top-header-right">
                <div class="down-top">
                    <select class="in-drop">
                        <option value="VietNamese" class="in-of">VIETNAMESE</option>
                        <option value="Japanese" class="in-of">Japanese</option>
                        <option value="French" class="in-of">French</option>
                        <option value="German" class="in-of">English</option>
                    </select>
                </div>
                <div class="down-top top-down">
                    <select class="in-drop">

                        <option value="VND" class="in-of">VND</option>
                        <option value="Dollar" class="in-of">Dollar</option>
                        <option value="Euro" class="in-of">Euro</option>
                    </select>
                </div>
                <!---->
                <div class="clearfix"> </div>
            </div> --}}
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="bottom-header">
        <div class="container">
            <div class="header-bottom-left">
                <div class="logo">
                    <a href="/index"><img src="images/logo.png" alt=" " /></a>
                </div>
                <div class="search">
                    <input type="text" name="search" id="search" value="" onfocus="this.value = '';"
                        onblur="if (this.value == '') {this.value = '';}">
                    <input type="submit" value="SEARCH">
                    <p href="#" id="load_product"></p>
                    <p href="#" id="search_product"></p>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="header-bottom-right">
                {{-- <div class="account"><a href=#><span> </span>TÀI KHOẢN CỦA BẠN</a></div> --}}
                <ul class="login">
                    @if (isset($user_info))
                        <li><a href=#></a>{{ $user_info->ten }}</li> | <br>
                        <li><a href='/logout'>ĐĂNG XUẤT</a></li> |
                    @else
                        <li><a href='/login'><span> </span>ĐĂNG NHẬP</a></li> |
                        <li><a href={{ url('register') }}>ĐĂNG KÝ</a></li>
                    @endif
                </ul>
                <div class="cart">

                    <div class="number_item_cart  @if (!session()->has('tong_so_luong')) hidden @endif">
                        @if (session()->has('tong_so_luong'))
                            {{ session('tong_so_luong') ?: '0' }}
                        @endif
                    </div>

                    <a href="/gio-hang"><span></span>GIỎ HÀNG</a>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        fetch_product_data();

        function fetch_product_data(query = '') {
            // alert('data_load' + query);
            $.ajax({
                url:"{{ route('action') }}",
                method: 'GET',
                data: {
                    query: query
                },
                dataType: 'json',
                success: function(data) {
                    $('#search_product').html(data.table_data);
                    $('#total_records').text(data.total_data);
                }
            })
        }

        $(document).on('keydown', '#search', function() {
            document.getElementById("load_product").className = 'lds-dual-ring';
            sleep(100000);
        })

        $(document).on('keyup', '#search', function() {

            document.getElementById("load_product").classList.remove("lds-dual-ring");;
            var query = $(this).val();
            fetch_product_data(query);
        });
    });
</script>
