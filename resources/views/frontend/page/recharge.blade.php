@extends('frontend.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('shopAcc/css/recharge.css') }}">
@endsection
@section('content')
    <div class="container-fluid vesitable" style="margin-top: 108px">
        <div class="container py-3">
            @if($slug === 'nap-the-cao')
                @include('frontend.page.partial.nap_the')
            @else
                @include('frontend.page.partial.nap_atm')
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
