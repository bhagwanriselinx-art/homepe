@extends('admin.master_layout')

@section('title')

<title>Edit Video</title>
@endsection

@section('admin-content')

<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Edit Video</h1>
</div>

<div class="section-body">

<a href="{{ route('admin.videos.index') }}" class="btn btn-primary mb-3">
    <i class="fas fa-list"></i> Video List
</a>

<div class="card">
<div class="card-body">

<form action="{{ route('admin.videos.update',$video->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row">


<div class="form-group col-12">
    <label>Title</label>
    <input type="text" name="title" value="{{ $video->title }}" class="form-control">
</div>

<div class="form-group col-12">
    <label>Upload New Video</label>
    <input type="file" name="video_file" class="form-control-file">
</div>

@if($video->video_file)
<div class="form-group col-12">
    <label>Current Video</label><br>
    <video width="300" controls>
        <source src="{{ asset($video->video_file) }}" type="video/mp4">
    </video>
</div>
@endif


</div>

<button class="btn btn-primary">Update</button>

</form>

</div>
</div>

</div>
</section>
</div>

@endsection
