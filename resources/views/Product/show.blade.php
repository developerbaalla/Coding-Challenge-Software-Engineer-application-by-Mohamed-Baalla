@extends('layouts.main')

@section('content')

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card h-100">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <h2 class="card-title">Products</h2>
              </div>
              <div class="col-sm-6 text-right">
                <a href="{{ route('product') }}" type="button" class="btn btn-lg btn-success">back</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

            <table class="table table-striped table-bordered">
              <tbody>
                <tr>
                  <th>Image</th>
                  <td><img src="{{url('/images/'.$product->image)}}" alt="Image" width="50px" /></td>
                </tr>
                <tr>
                  <th>Name</th>
                  <td>{{ $product->name }}</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>{{ $product->description }}</td>
                </tr>
                <tr>
                  <th>Price</th>
                  <td>{{ $product->price }}</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                  <th>Categories</th>
                  <td>
                    @foreach ($product->categories as $category)
                      <p>- {{ $category->name }}</p>
                    @endforeach
                  </td>
                </tr>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

@endsection