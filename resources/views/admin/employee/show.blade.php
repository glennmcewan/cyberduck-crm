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
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" disabled value="{{ $model->first_name }}" />
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" disabled value="{{ $model->last_name }}" />
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" disabled value="{{ $model->email }}" />
            </div>
            <div class="form-group">
                <label for="phone">Phone number</label>
                <input type="tel" class="form-control" id="phone" name="phone" disabled value="{{ $model->phone }}" />
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
