@extends('layouts.admin.base')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">{{ $model->name }}</h3>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
    @endif
    <form>
        <div class="box-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" disabled value="{{ $model->name }}" />
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" disabled value="{{ $model->email }}" />
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                @if (!empty($model->logo))
                  <img src="{{ asset('storage/images/'.$model->logo) }}" />
                @endif
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" disabled value="{{ $model->website }}" />
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
