@extends('layouts.app')

@section('content')
<x-card>
    <x-slot:title>CREATE NEW ROLE</x-slot:title>
    <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">ROLE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="ROLE NAME">
                </div>
            </div>
            @foreach($permission as $value)
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permission[{{$value->id}}]" value="{{$value->id}}">
                        <label class="form-check-label" for="exampleCheck2"> {{ $value->name }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info float-right">CREATE</button>
            {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
        </div>
        <!-- /.card-footer -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
    </form>
</x-card>
@endsection