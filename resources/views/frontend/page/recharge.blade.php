@extends('frontend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('shopAcc/css/recharge.css') }}">
@endsection
@section('content')
    <div class="container-fluid vesitable" style="margin-top: 108px">
        <div class="container py-3">
            @if($slug === 'nap-the-cao')
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <h3>Nạp thẻ cào tự động</h3>
                        <p class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Hướng dẫn nạp thẻ</p>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hướng dẫn nạp thẻ cào</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <form action="{{ route('web.recharge_card') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <select name="type" id="" class="form-control">
                                <option value="">-- Chọn loại thẻ --</option>
                                @foreach(config('define.TYPE_CARD') as $key => $label)
                                    <option value="{{ old('type') ?? $key }}"
                                        {{ (old('type') == $key) ? 'selected' : '' }}
                                    >{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <div class="parsley-required text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <select name="card_price" id="" class="form-control">
                                <option value="">-- Chọn mệnh giá --</option>
                                @foreach(config('define.CARD_VALUE') as $key => $label)
                                    <option value="{{ old('card_price') ?? $key }}"
                                        {{ (old('card_price') == $key) ? 'selected' : '' }}
                                    >{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('card_price')
                            <div class="parsley-required text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="number" class="form-control" placeholder="Mã số thẻ"
                                   value="{{ old('number') }}"
                            >
                            @error('number')
                            <div class="parsley-required text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="serial" class="form-control" placeholder="Số Seri"
                                value="{{ old('serial') }}"
                            >
                            @error('serial')
                            <div class="parsley-required text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm bg-secondary">Nạp thẻ</button>
                    </form>
                </div>
            @else
                <h3>NẠP TIỀN QUA ATM/MOMO</h3>
                @if(!empty($banks))
                    <div class="row">
                        <div class="note-transfer">
                            <p>Chuyển khoản qua ngân hàng & ví điện tử, ghi đúng nội dung chuyển khoản của bạn ở bên dưới. Tiền sẽ được cộng vào tài khoản Web của bạn sau 15s - 30s
                                =>> hotline zalo hỗ trợ nếu tiền qua chậm 0989999999.
                            </p>
                            <p><strong>Lưu ý: </strong><span>Trong trường hợp chuyển sai nội dung vui lòng liên hệ 0989999999 để được hỗ trợ cộng tiền.</span></p>
                            <p>Ví Dụ:</p>
                            <p>100k ATM/Momo = 100K tiền shop</p>
                            <p>500k ATM/Momo = 500K tiền shop</p>
                        </div>
                    </div>
                    <div class="row"><strong>Danh sách các tài khoản ATM/MOMO</strong></div>
                    @foreach($banks as $key => $bank)
                        <div class="row">
                            <div class="bank-item">
                                <p class="bank-title">{{ $key + 1 }}.</p>
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
                    @endforeach
                    <div class="row">
                        <p class="content-code">
                            <span class="bank-title">Nội dung chuyển khoản:</span>
                            <span class="code">{{ $code }}</span>
                            <span class="ms-2 btn bnt-copy-code" title="Sao chép">
                                <i class="far fa-copy"></i>
                            </span>
                        </p>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
@section('footer')
@endsection
@section('js')
    <script>
        /**
         * Copies the text passed as param to the system clipboard - Sao chép văn bản được chuyển dưới dạng tham số vào bảng tạm hệ thống
         * Check if using HTTPS and navigator.clipboard is available - Kiểm tra xem có sử dụng HTTPS và navigator.clipboard không
         * Then uses standard clipboard API, otherwise uses fallback - Sau đó sử dụng API clipboard tiêu chuẩn, nếu không thì sử dụng dự phòng
         */
        $(document).on('click', '.bnt-copy-code', function() {
            $('.bnt-copy-code').attr('title', 'Sao chép');
            let copyText = $(this).closest('.content-code').find('.code').text();
            const copyContent = async () => {
                try {
                    if (window.isSecureContext && navigator.clipboard) {
                        await navigator.clipboard.writeText(copyText);
                        $(this).attr('title', 'Đã sao chép');
                    } else {
                        unsecuredCopyToClipboard(copyText);
                        $(this).attr('title', 'Đã sao chép');
                    }
                } catch (err) {
                    console.error('Failed to copy: ', err);
                }
            }
            copyContent();
        });

        const unsecuredCopyToClipboard = (text) => {
            const textArea = document.createElement("textarea");
            textArea.value=text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try{
                document.execCommand('copy');
            } catch (err) {
                console.error('Unable to copy to clipboard', err)
            }
            document.body.removeChild(textArea);
        };
    </script>
@endsection
