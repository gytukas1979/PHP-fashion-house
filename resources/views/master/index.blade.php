@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>MASTERS</b>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($masters as $master)
                        <li class="list-group-item">
                            <div class="list-item-container">
                                <div class="list-item-container__content">
                                    {{$master->name}} {{$master->surname}}
                                </div>
                                <div class="list-item-container__buttons">
                                    <form method="POST" action="{{route('master.destroy', $master)}}">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-outline-success" href="{{route('master.edit',[$master])}}">EDIT</a>
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




