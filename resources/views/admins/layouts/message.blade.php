<style>
    .flash-message {
        position: fixed;
        top: 170px;
        right: 20px;
        padding: 14px;
        z-index: 1000;
    }
    .flash-message button span {
        position: absolute;
        top: 0;
        right:8px;
        font-size: 20px;
        color: #FFFFFF;
    }
</style>
@if ($errors->any())
    <div class="text-center alert alert-danger alert-dismissible fade show flash-message" role="alert">
        <ul style="list-style: none">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success text-center flash-message">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning text-center flash-message">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('info'))
    <div class="alert alert-info text-center flash-message">
        {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('danger'))
    <div class="text-center alert alert-danger flash-message" role="alert">
        {{ session('danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
