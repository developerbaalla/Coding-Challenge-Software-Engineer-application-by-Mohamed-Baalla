@extends('layouts.main')

@section('content')

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-12">
        <div class="card h-100">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-6">
                <h2 class="card-title">Edit Product</h2>
              </div>
              <div class="col-sm-6 text-right">
                <a href="{{ route('product') }}" type="button" class="btn btn-lg btn-success">back</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

            {!! Form::open(['url' => ['product/update', $product->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
              <div class="form-group">
                {{ Form::label('name', 'Product Name') }}
                {{ Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}
              </div>
              <div class="form-group">
                {{ Form::label('price', 'Price') }}
                {{ Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Enter Price']) }}
              </div>
              <div class="form-group">
                {{ Form::label('description', 'Product Description') }}
                {{ Form::textarea('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Enter Description']) }}
              </div>
              <div class="form-group">
                {{ Form::label('image', 'Product Image') }}
                {{ Form::file('image') }}
              </div>
              <div>
                {{ Form::submit('Save', ['class' => 'form-control btn btn-lg btn-success']) }}
              </div>
            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

@endsection