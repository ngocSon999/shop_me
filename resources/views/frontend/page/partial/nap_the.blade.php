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
