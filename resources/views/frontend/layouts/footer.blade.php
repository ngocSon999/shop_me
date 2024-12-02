<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 pb-4 footer mt-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="footer-item">
                    <img src="{{ asset(getSetting('logo_footer')) }}" alt="" style="width: 100%; height: 200px; margin-top: -30px">
                    <p class="mb-4">Sàn Giao dịch Mua Bán Nick game tự do mà không cần cọc, nạp, rút tiền về ATM/MOMO/CARD tự động</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Thông tin về Shop</h4>
                    <a class="btn-link" href="">About Us</a>
                    <a class="btn-link" href="">Contact Us</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Hotline</h4>
                    <p>Email: <a href="mailto: {{ getSetting('email') }}">{{ getSetting('email') }}</a></p>
                    <p>Phone: <a href="tel: {{ getSetting('phone') }}">{{ getSetting('phone') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-center text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Shop acc game</a></span>
                <span class="ps-2 text-white">Designed By <a class="border-bottom" href="https://htmlcodex.com">NNT Devcui</a></span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
