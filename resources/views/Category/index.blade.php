@extends('layouts.main')

@section('content')

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card h-100">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <h2 class="card-title">Categories</h2>
              </div>
              <div class="col-sm-6 text-right">
                <a href="{{ route('category.create') }}" type="button" class="btn btn-lg btn-success">Add Category</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Categoy</th>
                  <th>Children</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories as $category)
                
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    @foreach ($category->childrenRecursive as $child)
                      <p>- {{ $child->name }}</p>
                    @endforeach
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

@endsection