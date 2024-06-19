@extends('layouts.app')

@section('content')
<x-card>
    <x-slot:title>CREATE NEW PERMISSION</x-slot:title>
    <form class="form-horizontal" method="POST" action="{{ route('permissions.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">PERMISSION</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="PERMISSION NAME">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info float-right">CREATE</button>
            {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
        </div>
        <!-- /.card-footer -->
    </form>
</x-card>
@endsection