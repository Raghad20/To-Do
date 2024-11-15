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
        <th scope="col">Users Details</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users_tasks as $task)
            <tr>
        <th scope="row">{{ $task->id }}</th>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>{{ $task->type->name }}</td>
        <td>{{ $task->created_at->format('y-m-d')}}</td>
        <td>
        <ul>
          @foreach ($task->users as $users)
          <li>{{ $users->name }} ({{ $users->pivot->due_date }})  @if($users->pivot->is_done)
            (Completed)
            @else
            (Not Completed)
            @endif
            </li>
            @endforeach
        </ul>
        </td>
            </tr>
       
        @endforeach
    </tbody>
  </table>
@endsection 