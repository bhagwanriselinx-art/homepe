@extends('admin.master_layout')
@section('title')
<title>Edit Child Sub Type</title>
@endsection

@section('admin-content')

<div class="main-content">
<section class="section">
<div class="section-header">
<h1>Edit Child Sub Property Type</h1>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">

<form action="{{ route('admin.child-sub-type.update',$type->id) }}" method="POST">
@csrf

<div class="form-group">
<label>Select Sub Property Type *</label>
<select name="sub_property_type_id" class="form-control">
@foreach($subTypes as $sub)
<option value="{{ $sub->id }}"
@if($sub->id == $type->sub_property_type_id) selected @endif>
{{ $sub->name }}
</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Name *</label>
<input type="text" name="name" value="{{ $type->name }}" class="form-control">
</div>

<div class="form-group">
<label>
<input type="checkbox" name="status" {{ $type->status ? 'checked' : '' }}> Active
</label>
</div>

<button class="btn btn-primary">Update</button>

</form>

</div>
</div>
</div>
</section>
</div>

@endsection