@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>CREATE OUTFIT</b>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('outfit.store')}}">
                        @csrf
                        <div class="form-group">
                            <label>Type:</label>
                            <input type="text" class="form-control" name="outfit_type" value="{{old('outfit_type')}}">
                            <small class="form-text text-muted">Add type</small>
                        </div>
                        <div class="form-group">
                            <label>Color:</label>
                            <input type="text" class="form-control" name="outfit_color" value="{{old('outfit_color')}}">
                            <small class="form-text text-muted">Add color</small>
                        </div>
                        <div class="form-group">
                            <label>Size:</label>
                            <input type="text" class="form-control" name="outfit_size" value="{{old('outfit_size')}}">
                            <small class="form-text text-muted">Add size</small>
                        </div>
                        <div class="form-group">
                            <label>Select master:</label>
                            <select name="master_id" class="form-control">
                                @foreach ($masters as $master)
                                    <option value="{{$master->id}}" @if($master->id == old('master_id')) selected @endif>{{$master->name}} {{$master->surname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


