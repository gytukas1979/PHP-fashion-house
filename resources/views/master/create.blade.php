@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>CREATE MASTER</b>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('master.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="master_name" value="{{old('master_name')}}">
                            <small class="form-text text-muted">Add name</small>
                        </div>
                        <div class="form-group">
                            <label>Surname:</label>
                            <input type="text" class="form-control" name="master_surname" value="{{old('master_surname')}}">
                            <small class="form-text text-muted">Add surname</small>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

