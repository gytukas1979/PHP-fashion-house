@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="index-header"> 
                        <b>OUTFITS</b>
                        <div class="sorter">
                            <form action="{{route('outfit.index')}}" method="get">
                                <span>Filter by master</span>
                                <select name="master_id">
                                    <option value="all">
                                        <b>All masters</b>
                                    </option>
                                    @foreach ($masters as $master)
                                        <option value="{{$master->id}}" @if($master->id == $master_id) selected @endif>
                                            {{$master->name}} {{$master->surname}}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    FILTER
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($outfits as $outfit)
                        <li class="list-group-item">
                            <div class="list-item-container">
                                <div class="list-item-container__content">
                                    <span><b>{{$outfit->type}}</b></span>
                                    <small><i>Color: {{$outfit->color}}</i></small>
                                    <small><i>Size: {{$outfit->size}}</i></small>
                                    <small>made by {{$outfit->outfitMaster->name}} {{$outfit->outfitMaster->surname}}</small>
                                </div>
                                <div class="list-item-container__buttons">
                                    <form method="POST" action="{{route('outfit.destroy', [$outfit])}}">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-outline-success" href="{{route('outfit.edit',[$outfit])}}">EDIT</a>
                                        <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
