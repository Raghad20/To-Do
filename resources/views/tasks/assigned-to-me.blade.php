@extends('layouts.master')
@section('content')
<table class="table table-bordered border-primary">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Task Title</th>
        <th scope="col">Task Description</th>
        <th scope="col">Task Type</th>
        <th scope="col">Task Date</th>
        <th scope="col">Due Date</th>
        <th scope="col">Is Done</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
        <th scope="row">{{ $task->id }}</th>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>{{ $task->type->name }}</td>
        <td>{{ $task->created_at->format('y-m-d')}}</td>
        <td>{{ $task->pivot->due_date }}</td>
        @if (!$task->pivot->is_done)
        <td>
        <form method="POST" action="{{route('complete-status',$task->id)}}">
            @csrf
             <button type="submit" class="btn btn-primary">Complete</button>
        </form>
      </td>
        @else
        <td>
        <form method="POST" action="{{route('incomplete-status',$task->id)}}">
            @csrf
            <button type="submit" class="btn btn-secondary">InComplete</button>
        </form>
      </td>
        @endif
      </tr> 
        @endforeach
     
    </tbody>
  </table>
@endsection 