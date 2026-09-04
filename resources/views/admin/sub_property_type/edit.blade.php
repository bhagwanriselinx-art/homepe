@extends('admin.master_layout')
@section('title')
<title>Edit Sub Property Type</title>
@endsection

@section('admin-content')
<div class="main-content">
<section class="section">
<div class="section-header">
    <h1>Edit Sub Property Type</h1>
</div>

<div class="section-body">

<form action="{{ route('admin.sub-property-type.update',$subType->id) }}" method="POST">
@csrf
@method('PUT')

<div class="form-group">
    <label>Property Type</label>
    <select name="category_id" class="form-control" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $subType->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }} ({{ $category->category_type }})
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" 
           value="{{ $subType->name }}" 
           class="form-control" required>
</div>

<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug" 
           value="{{ $subType->slug }}" 
           class="form-control" required>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1" {{ $subType->status == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $subType->status == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<button class="btn btn-primary">Update</button>

</form>

</div>
</section>
</div>
@endsection