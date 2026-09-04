@extends('admin.master_layout')
@section('title')
<title>Child Sub Property Types</title>
@endsection

@section('admin-content')

<div class="main-content">
<section class="section">
<div class="section-header">
<h1>Child Sub Property Types</h1>
<a href="{{ route('admin.child-sub-type.create') }}" class="btn btn-primary">
<i class="fas fa-plus"></i> Add New
</a>
</div>

<div class="section-body">
<div class="card">
<div class="card-body">

<table class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Sub Type</th>
<th>Name</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
@foreach($types as $key => $type)
<tr>
<td>{{ $key+1 }}</td>
<td>{{ $type->subPropertyType->name ?? '' }}</td>
<td>{{ $type->name }}</td>
<td>
@if($type->status)
<span class="badge badge-success">Active</span>
@else
<span class="badge badge-danger">Inactive</span>
@endif
</td>
<td>
<a href="{{ route('admin.child-sub-type.edit',$type->id) }}" class="btn btn-sm btn-warning">Edit</a>
<a href="{{ route('admin.child-sub-type.delete',$type->id) }}" 
   onclick="return confirm('Are you sure?')" 
   class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
@endforeach
</tbody>

</table>

</div>
</div>
</div>

</section>
</div>

@endsection