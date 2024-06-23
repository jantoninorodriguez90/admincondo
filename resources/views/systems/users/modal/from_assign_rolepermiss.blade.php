<form class="form-horizontal form-false" method="POST" action="#" id="form-assign">
    @csrf
    <div class="card-body text-left">
        <div class="form-group">            
            <label for="role" class="col-sm-2 col-form-label">ROLES LIST</label>
            <select class="custom-select form-control-border" id="role" name="role">
                <option value="">Choose one...</option>
                @foreach ($roles as $item)
                    <option value="{{ $item->name }}" {{ isset($user_roles[$item->name]) ? 'selected' : ''}} >{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer">
        <button type="button" class="btn btn-info float-right" onclick="btn_create()" id="btnCreate">CREATE</button>
        <button type="button" class="btn btn-info float-right" onclick="btn_update()" id="btnUpdate">UPDATE</button>
        <button type="button" class="btn btn-default float-right">Cancel</button>
    </div> --}}
    <!-- /.card-footer -->
</form>