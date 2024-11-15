@extends('layouts.master')
@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title"> Form </h5>
      <form id="my-form" method="POST" action="{{ route('assign-to-user',$taskId) }}">
        @csrf
        <div class="form-floating mb-3">
            @foreach ($users as $user)
            <tr>
                <td><input {{ $user->value ? 'checked' : null }} data-id="{{ $user->id }}" type="checkbox" class="user-enable"></td>
                <td>{{ $user->name }}</td>
                <td><input value="{{ $user->value ?? null }}" {{ $user->value ? null : 'disabled' }} data-id="{{ $user->id }}" name="ingredients[{{ $user->id }}]" type="date" class="ingredient-amount form-control" ></td>
            </tr>
            @endforeach
          </div>
          
                  
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Assign</button>
              </div>
          </div>
        </div>


      </form><!-- End General Form Elements -->

    </div>
  </div>
  @section('scripts')
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script>
      $('document').ready(function () {
          $('.user-enable').on('click', function () {
              let id = $(this).attr('data-id')
              let enabled = $(this).is(":checked")
              $('.ingredient-amount[data-id="' + id + '"]').attr('disabled', !enabled)
              $('.ingredient-amount[data-id="' + id + '"]').val(null)
          })
      });
  </script>
@endsection
</body>
</html>
@endsection