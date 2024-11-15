@extends('layouts.master')
@section('content')

    <div class="row">
    @foreach ($types as $type)
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $type->name }}</h5>
          <a href="{{ route('task-index', $type->id ) }}" class="card-link">Tasks</a>
    
        </div>
      </div>
    
</div>
    @endforeach
    @if(auth()->user()->is_admin)
    <div class="col-md-3">
    <div class="card" style="height: 60%">
      <div class="card-body">
        <h5 class="card-title">Add New Type <a href="{{ route('types.create') }}" class="card-link" style="font-size:300%;padding:35% ;">+</a></h5>
      </div>
      </div>
    </div>
    @endif
    </div>

@endsection