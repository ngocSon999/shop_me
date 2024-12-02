<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" style="background-color: #0974A0" data-toggle="modal" data-target="#exampleModal">
    Add discount price all product
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add discount price</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-add-discount">
                <label style="width: 100%">
                    Discount price:
                    <input class="form-control" type="number" min="0" max="100" name="discount_price">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="add-discount-price" type="button" class="btn btn-primary">Save change</button>
            </div>
        </div>
    </div>
</div>
