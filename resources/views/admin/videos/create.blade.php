@extends('admin.master_layout')

@section('title')

<title>Add Video</title>
@endsection

@section('admin-content')

<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Add Video</h1>
</div>

<div class="section-body">

<a href="{{ route('admin.videos.index') }}" class="btn btn-primary mb-3">
    <i class="fas fa-list"></i> Video List
</a>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">


<div class="form-group col-12">
    <label>Title <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
</div>

<div class="form-group col-12">
    <label>Upload Video <span class="text-danger">*</span></label>
    <input type="file" name="video_file" class="form-control-file" accept="video/*">
</div>


</div>

<button class="btn btn-primary">Save</button>

</form>

</div>
</div>

</div>
</section>
</div>

@endsection
