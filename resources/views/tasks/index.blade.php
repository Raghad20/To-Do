@extends('layouts.master')
@section('content')
@if(auth()->user()->is_admin)
<div class="card">
    <div class="card-body">
      <h5 class="card-title"> Form </h5>
      <form method="POST" action="{{ route('task-store', $id ) }}">
        @csrf
        <div class="row mb-3">
          <div class="col-sm-10">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="title" >
              <label for="floatingInput">Task Title:</label>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" name="description" placeholder="Leave a description here" id="floatingTextarea" style="height: 100px;"></textarea>
              <label for="floatingTextarea">Task Description:</label>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>

              </div>
          </div>
        </div>


      </form><!-- End General Form Elements -->

    </div>
  </div>
  @endif
   <div class="row">
    @foreach ($tasks as $task)
<div class="col-md-3">
    <div class="card">
        <div class="card-body">
                    <h5 class="card-title">{{ $task->title }}</h5>
          <h6 class="card-subtitle mb-2 text-muted">{{ $task->type->name }}</h6>
              <p class="card-text">{{ $task->description }}</p>
              @if(auth()->user()->is_admin)
              <a href="{{ route('assign-index',$task->id)}} " class="card-link">Assign to user</a>
              @endif
        </div>
      </div>
    
</div>
    @endforeach
    </div>

@endsection