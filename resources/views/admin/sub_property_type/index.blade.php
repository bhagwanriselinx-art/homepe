@extends('admin.master_layout')
@section('title')
<title>Sub Property Type</title>
@endsection

@section('admin-content')
<div class="main-content">
<section class="section">
<div class="section-header">
    <h1>Sub Property Type</h1>
</div>

<div class="section-body">

<a href="{{ route('admin.sub-property-type.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Add New
</a>

<div class="card">
<div class="card-body">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Property Type</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subTypes as $key => $item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item->category->name ?? '' }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->slug }}</td>
            <td>
                {{ $item->status == 1 ? 'Active' : 'Inactive' }}
            </td>
            <td>
                <a href="{{ route('admin.sub-property-type.edit',$item->id) }}" 
                   class="btn btn-sm btn-primary">
                   Edit
                </a>

                <form action="{{ route('admin.sub-property-type.destroy',$item->id) }}" 
                      method="POST" 
                      style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
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