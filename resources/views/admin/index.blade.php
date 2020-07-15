@extends('layouts.admin.base')

@section('content')
<div class="box">
    <div class="box-body no-padding">
        <table class="table table-striped">
            <tr>
                <th style="width: 10px">#</th>
                @foreach ($columns as $column)
                  <th>{{ $column }}</th>
                @endforeach
                <th style="width: 10px">
                  View
                </th>
                <th style="width: 10px">
                  Edit
                </th>
            </tr>
            @foreach ($rows as $row)
              <tr>
              @foreach ($row as $cell)
                <td>{{ $cell }}</td>
              @endforeach
                <td>
                  <a href="{{ route('admin.companies.show', $row['id']) }}">
                    <i class="nav-icon fas fa-search"></i>
                  </a>
                </td>
                <td>
                  <a href="{{ route('admin.companies.edit', $row['id']) }}">
                    <i class="nav-icon fas fa-edit"></i>
                  </a>
                </td>
              </tr>
            @endforeach
        </table>

        {{ $paginator->links() }}
    </div>
</div>
@endsection
