<div class="row">
    <div class="col-12 col-md-6">
        <h3 class="card-title-page">Nạp thẻ cào tự động</h3>
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
            <button type="submit" class="btn btn-sm btn-primary">Nạp thẻ</button>
        </form>
    </div>
    <div class="col-12 col-md-6">
        <h3 class="card-title-page">Hướng dẫn nạp thẻ</h3>
        <div style="text-align: justify">
            <p>Khách hàng nạp thẻ trực tiếp tại trang này hoặc liên hệ Hotline 0989999999. Thẻ sau khi được gửi tiền sẽ được cộng
            vào tài khoản web sau 15 đến 30s.
            </p>
        </div>
    </div>
</div>
