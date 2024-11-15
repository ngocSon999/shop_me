<style>
.flash-message {
    position: absolute;
    margin-top: 14px;
    padding: 14px;
    right: 0;
    z-index: 999;
}
.flash-message button {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 15px;
}
</style>

@if(session('success'))
    <div class="alert alert-success text-center flash-message">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning text-center flash-message">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('info'))
    <div class="alert alert-info text-center flash-message" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('danger'))
    <div class="text-center alert alert-danger flash-message" role="alert">
        {{ session('danger') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
