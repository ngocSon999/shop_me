<h3>NẠP TIỀN QUA ATM/MOMO</h3>
@if(!empty($banks))
    <div class="row">
        <div class="note-transfer">
            <p>Chuyển khoản qua ngân hàng & ví điện tử, ghi đúng nội dung chuyển khoản của bạn ở bên dưới. Tiền sẽ được
                cộng vào tài khoản Web của bạn sau 15s - 30s
                =>> hotline zalo hỗ trợ nếu tiền quá chậm 0989999999.
            </p>
            <p class="pt-2"><strong>Lưu ý: </strong><span>Trong trường hợp chuyển sai nội dung vui lòng liên hệ 0989999999 để được hỗ trợ cộng tiền.</span>
            </p>
            <p class="pt-2"><b>Ví Dụ:</b></p>
            <p>100k ATM/Momo = 100K tiền shop</p>
            <p>500k ATM/Momo = 500K tiền shop</p>
        </div>
    </div>
    <div class="row mb-2">
        <p class="content-code">
            <span class="bank-title">NỘI DUNG CHUYỂN KHOẢN:</span>
            <span class="code">{{ $code }}</span>
            <span class="ms-2 btn bnt-copy-code" title="Sao chép">
                <i class="far fa-copy"></i>
            </span>
        </p>
    </div>
    <div class="row">
        @foreach($banks as $key => $bank)
            @if($bank->type == 1)
                <div class="col-12 col-xl-6 mb-4">
                    <div class="bank-item">
                        <p><span class="bank-title">{{ $key + 1 }}. Tài khoản ATM</span></p>
                        <p><span class="bank-title">Tên Ngân hàng: </span><span>{{ $bank->bank_name }}</span></p>
                        <p class="content-code">
                            <span class="bank-title">Số tài khoản: </span>
                            <span class="code">{{ $bank->bank_number }}</span>
                            <span class="ms-2 btn bnt-copy-code" title="Sao chép">
                                <i class="far fa-copy"></i>
                            </span>
                        </p>
                        <p><span class="bank-title">Chi nhánh ngân hàng: </span><span>{{ $bank->bank_address }}</span></p>
                        <p><span class="bank-title">Chủ tài khoản: </span><span>{{ $bank->bank_account }}</span></p>
                    </div>
                </div>
            @else
                <div class="col-12 col-xl-6 mb-4">
                    <div class="bank-item">
                        <p><span class="bank-title">{{ $key + 1 }}. Tài khoản MOMO</span></p>
                        <p class="content-code">
                            <span class="bank-title">Số tài khoản: </span>
                            <span class="code">{{ $bank->bank_number }}</span>
                            <span class="ms-2 btn bnt-copy-code" title="Sao chép">
                            <i class="far fa-copy"></i>
                        </span>
                        </p>
                        <p><span class="bank-title">Chủ tài khoản: </span><span>{{ $bank->bank_account }}</span></p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif
