@extends('admin.master_layout')
@section('title')
<title>Add Child Sub Type</title>
@endsection

@section('admin-content')

<div class="main-content">
<section class="section">
<div class="section-header">
<h1>Add Child Sub Property Type</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">

<form action="{{ route('admin.child-sub-type.store') }}" method="POST">
@csrf

<div class="form-group">
<label>Select Sub Property Type *</label>
<select name="sub_property_type_id" class="form-control">
<option value="">Select</option>
@foreach($subTypes as $sub)
<option value="{{ $sub->id }}">{{ $sub->name }}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Name *</label>
<input type="text" name="name" class="form-control">
</div>

<div class="form-group">
<label>
<input type="checkbox" name="status" checked> Active
</label>
</div>

<button class="btn btn-primary">Save</button>

</form>

</div>
</div>
</div>
</section>
</div>

@endsection