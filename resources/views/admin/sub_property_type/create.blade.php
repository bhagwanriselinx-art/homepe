@extends('admin.master_layout')
@section('title')
<title>Create Sub Property Type</title>
@endsection

@section('admin-content')
<div class="main-content">
<section class="section">
<div class="section-header">
    <h1>Create Sub Property Type</h1>
</div>

<div class="section-body">

<form action="{{ route('admin.sub-property-type.store') }}" method="POST">
@csrf

<div class="form-group">
    <label>Property Type</label>
    <select name="category_id" class="form-control" required>
        <option value="">Select Property Type</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }} ({{ $category->category_type }})
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug" class="form-control" required>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
</div>

<button class="btn btn-primary">Save</button>

</form>

</div>
</section>
</div>
@endsection