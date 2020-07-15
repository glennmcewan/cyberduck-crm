@extends('layouts.admin.base')

@section('content')
<div class="box box-primary">
    @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.companies.store') }}" role="form">
      @csrf
        <div class="box-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Company name" />
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="foo@example.org" />
            </div>
            <div class="form-group">
                <label for="logo">Logo Upload</label>
                <input type="file" id="logo" name="logo">

                <p class="help-block">This will overwrite your existing logo, if it exists.</p>
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control" id="website" name="website" placeholder="https://example.org" />
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
