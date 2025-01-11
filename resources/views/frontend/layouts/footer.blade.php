<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 pb-4 footer mt-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-4 col-12">
                <div class="footer-item">
                    <img src="{{ asset(getSetting('logo_footer')) }}" alt="" style="width: 100%; height: 200px; margin-top: -30px">
                    <p class="mb-4" style="text-align: justify">{{ getSetting('description_footer') ?? '' }}</p>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Hotline</h4>
                    <p>Email: <a href="mailto: {{ getSetting('email') }}">{{ getSetting('email') }}</a></p>
                    <p>Phone: <a href="tel: {{ getSetting('phone') }}">{{ getSetting('phone') }}</a></p>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Địa chỉ</h4>
                    <p>{{ getSetting('address') ?? '' }}</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1868.2804578100886!2d105.97926661501197!3d20.524218431585123!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135daae1e00ff27%3A0x2e56e13b1f78747!2zTmjDoCBUaOG7nSBHacOhbyBY4bupIFRoxrDhu6NuZyBUcmFuZw!5e0!3m2!1svi!2s!4v1736584711388!5m2!1svi!2s" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                <span class="text-light"><i class="fas fa-copyright text-light me-1"></i>{{ \Illuminate\Support\Facades\Date::now('ASIA/Ho_Chi_Minh')->format('Y') }}</span>
                <span class="ps-2 text-white">Designed By <a class="border-bottom" href="mailto: ntsh9015@gmail.com" title="SendMail">NNT Devcui</a></span>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->
