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
                <a href="{{ route('product.create') }}" type="button" class="btn btn-lg btn-success">Add Product</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

            <div class="card card-body bg-light">
            {!! Form::open(['url' => 'product', 'method' => 'get']) !!}
              <div class="row">
                <div class="col-sm-4">
                  <div class="radio">
                    @if (Request::get('sort') == 'name')
                      <label>{{ Form::radio('sort', 'name', true) }} &nbsp&nbsp Sort by name</label>
                    @else
                      <label>{{ Form::radio('sort', 'name', false) }} &nbsp&nbsp Sort by name</label>
                    @endif
                  </div>
                  <div class="radio">
                    @if (Request::get('sort') == 'price')
                      <label>{{ Form::radio('sort', 'price', true) }} &nbsp&nbsp Sort by price</label>
                    @else
                      <label>{{ Form::radio('sort', 'price', false) }} &nbsp&nbsp Sort by price</label>
                    @endif
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    {{ Form::select('category', $categories, Request::get('category'), ['class' => 'form-control', 'placeholder' => 'Choise Category']) }}
                  </div>
                </div>
                <div class="col-sm-4 text-right">
                  {{ Form::submit('search', ['class' => 'btn btn-lg btn-info']) }}
                </div>
              </div>
            {!! Form::close() !!}
            </div><br>

            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Categories</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                
                <tr>
                  <td><img src="{{url('/images/'.$product->image)}}" alt="Image" width="50px" /></td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->description }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->created_at }}</td>
                  <td>
                    @foreach ($product->categories as $category)
                      <p>- {{ $category->name }}</p>
                    @endforeach
                  </td>
                  <td>
                    <a href="{{ route('product.show', ['id' => $product->id]) }}" type="button" class="btn btn-sm btn-info">Show</a>
                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" type="button" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="{{ route('product.destroy', ['id' => $product->id]) }}" type="button" class="btn btn-sm btn-danger">Delete</a>
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