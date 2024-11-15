@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title"> Form</h5>

      <!-- Vertical Form -->
      <form class="row g-3" method="POST" action="{{ route('types.update') }}">
        @csrf
        @method('PUT')
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Type Name</label>
          <input type="text" value="{{ $type->name }}" class="form-control" id="inputNanme4" name="name">
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form><!-- Vertical Form -->

    </div>
  </div>
@endsection