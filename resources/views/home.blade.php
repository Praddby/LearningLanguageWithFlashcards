@extends('layouts.app')

@section('content')
<div class="container">
  <div class="container">
    <div class="row justify-content">
      <div class="col-md-4 mb-4">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif               
        <button type="button" class="btn btn-success" id="addCard">Добавить карточку</button>
        <div id="modal_form" class="modal" tabindex="-1" role="dialog"><!-- Сaмo oкнo --> 
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Добавить карточку</h5>
                <button id="modal_close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('form-add-cards') }}" method="POST" id="form-add-cards">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="row mb-2">
                    <div class="col">
                      <input type="text" class="form-control" name="name_category" value="{{ old('name_category') }}" placeholder="Название карточки">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <input type="text" class="form-control" name="name_original[]" placeholder="Слово в оригинале">
                    </div>
                    <div class="col">
                      <input type="text" class="form-control" name="name_translation[]" placeholder="Перевод">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="not" data-dismiss="modal">Закрыть</button>
                <button type="submit" form="form-add-cards" class="btn btn-primary">Добавить карточку</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <cards-component></cards-component>
  </div>
</div>

@endsection
