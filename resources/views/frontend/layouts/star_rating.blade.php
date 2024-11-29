@if(Auth::user())
    <i type="button" class="feedback fa fa-envelope" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="message-feedback" class="col-form-label">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" maxlength="500" id="message-feedback"></textarea>
                    </div>
                    <div>
                        <ul id="star_rating">
                            @for($i = 0; $i < 5; $i++)
                                <li class="star_rating" data-value="{{ $i }}"><i class="fas fa-star"></i></li>
                            @endfor
                        </ul>
                        <input type="hidden" id="rating">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="send-feedback" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>

</script>
