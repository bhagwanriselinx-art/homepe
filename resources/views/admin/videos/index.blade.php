@extends('admin.master_layout')

@section('title')
<title>Video List</title>
@endsection

@section('admin-content')

<div class="main-content">
<section class="section">

<div class="section-header">
    <h1>Video List</h1>
</div>

<div class="section-body">

<a href="{{ route('admin.videos.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Add Video
</a>

<div class="card">
<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-striped">

<thead>
<tr>
    <th>#</th>
    <th>Title</th>
    <th>Video</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@forelse($videos as $key => $video)
<tr>
    <td>{{ $key + 1 }}</td>

    <td>{{ $video->title }}</td>

    <td width="250">
        @if($video->video_file)
            <video width="200" controls>
                <source src="{{ asset($video->video_file) }}" type="video/mp4">
                Your browser does not support video.
            </video>
        @else
            <span class="text-danger">No Video</span>
        @endif
    </td>

    <td width="150">
        <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i>
        </a>

        <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-sm btn-danger"
                onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center">No videos found</td>
</tr>
@endforelse

</tbody>

</table>
</div>

</div>
</div>

</div>
</section>
</div>

@endsection