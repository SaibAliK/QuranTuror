<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title font-weight-bold mt-0">Edit Request</h3>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="material-icons">clear</i>
            </button>
        </div>
        <form action="{{ route('admin.request_tutor.save') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $item->id }}">
            <div class="modal-body edit_modal_body">
                <div class="form-group">
                    <label for="date"> Date *</label>
                    <input type="text" class="form-control datepicker position-relative @error('date') is-invalid @enderror" value="{{$item->date}}" id="date" required="true" name="date" autocomplete="off" readonly>
                    @error('date')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
                <div class="form-group">
                    <label for="acative_date">Active Date *</label>
                    <input type="text" class="form-control datepicker position-relative @error('active_date') is-invalid @enderror" value="{{$item->active_date}}" id="acative_date" required="true" name="active_date" autocomplete="off" readonly>
                    @error('active_date')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
                <div class="form-group">
                    <label for="date"> Time / Slot *</label>
                    <input type="text" class="form-control position-relative clockpicker @error('slot') is-invalid @enderror" value="{{$item->slot}}" id="name" required="true" name="slot" autocomplete="off" readonly>
                    @error('slot')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-rose mr-2">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>