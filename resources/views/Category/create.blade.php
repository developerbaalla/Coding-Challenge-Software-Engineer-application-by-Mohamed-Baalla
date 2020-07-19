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
                <a href="{{ route('category') }}" type="button" class="btn btn-lg btn-success">back</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

            {!! Form::open(['url' => 'category/store', 'method' => 'put']) !!}
              <div class="form-group">
                {{ Form::label('name', 'Category') }}
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}
              </div>
              <div class="form-group">
                {{ Form::label('parent_category', 'Parent Category') }}
                {{ Form::select('parent_category', $categories, null, ['class' => 'form-control', 'placeholder' => 'Enter Parent Category']) }}
              </div>
              <div>
                {{ Form::submit('submit', ['class' => 'form-control btn btn-lg btn-success']) }}
              </div>
            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->

@endsection