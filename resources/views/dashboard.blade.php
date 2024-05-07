@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container-fluid">
    <div class="row justify-content-center mt-5">
      <div class="col-12 text-center">
        <h1>Dashboard</h1>
      </div>

    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card bg-primary text-white">
          <div class="card-body">
            <h5 class="card-title">Add Expense</h5>
            <p class="card-text">This is card 1 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click here</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-warning text-white">
          <div class="card-body">
            <h5 class="card-title">All Expenses</h5>
            <p class="card-text">This is card 2 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click here</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-success text-white">
          <div class="card-body">
            <h5 class="card-title">Overall Income</h5>
            <p class="card-text">This is card 3 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click Here</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card bg-secondary text-white">
          <div class="card-body">
            <h5 class="card-title">Overall Expenses</h5>
            <p class="card-text">This is card 4 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click Here</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-dark text-white">
          <div class="card-body">
            <h5 class="card-title">Last 5 Expenses</h5>
            <p class="card-text">This is card 5 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click Here</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-info text-white">
          <div class="card-body">
            <h5 class="card-title">Last 5 Incomes</h5>
            <p class="card-text">This is card 6 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click here</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card bg-warning text-white">
          <div class="card-body">
            <h5 class="card-title">Edit Expense</h5>
            <p class="card-text">This is card 7 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click Here</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 ">
        <div class="card bg-success text-white">
          <div class="card-body">
            <h5 class="card-title">View Expense</h5>
            <p class="card-text">This is card 8 content.</p>
            <a href="#" class="btn btn-dark btn-block">Click Here</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bg-danger text-white">
          <div class="card-body">
            <h5 class="card-title">Delete Expense</h5>
            <p class="card-text">This is card 9 content.</p>
            <a href="#" class="btn btn-danger btn-block">click here</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
