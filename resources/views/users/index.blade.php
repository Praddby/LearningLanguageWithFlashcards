@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-default">
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <user-nav></user-nav>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <component :is="usercomponent"></component>
      </div>
    </div>
  </div>
 
@endsection
