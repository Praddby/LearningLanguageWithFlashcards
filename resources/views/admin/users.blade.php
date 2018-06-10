@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <a class="btn btn-primary mb-4" href="{{ route('home') }}">Назад</a>
  </div>
  <table class="table table-bordered">
    <tr>
      <th>№</th>
      <th>Имя</th>
      <th>E-mail</th>
      <th>Роли</th>
      <th width="320px">Действия</th>
    </tr>
    @foreach ($data as $key => $user)
    <tr>
      <td>{{ ++$i }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>
        @if(!empty($user->getRoleNames()))
          <label class="badge badge-success">{{ $user->getRoleNames() }}</label>
        @endif
      </td>
      <td>
        <a class="btn btn-info" href="#">Показать</a>
        <a class="btn btn-primary" href="#">Изменить</a>
        <a class="btn btn-danger" href="#">Удалить</a>
      </td>
    </tr>
    @endforeach
  </table>


  {!! $data->render() !!}
</div>

@endsection
