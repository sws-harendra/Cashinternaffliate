@extends('backend.admins.layouts.base')

@push('title')
<title>Training Videos | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Header -->
    <div class="page-header">
        <div class="page-block">
            <h5 class="m-b-10">Training Videos</h5>
            <p class="m-b-0">Manage all training videos</p>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Videos List</h5>
                        <a href="{{ route('admins.training-videos.create') }}" 
                           class="btn btn-primary btn-sm float-right">Add New</a>
                    </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Video URL</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($videos as $i => $v)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $v->title }}</td>
                                        <td>{{ $v->subcategory->name ?? 'N/A' }}</td>
                                        <td><a href="{{ $v->video_url }}" target="_blank">Open</a></td>
                                        <td>{{ $v->duration ? $v->duration.' sec' : '—' }}</td>

                                        <td>
                                            @if($v->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admins.training-videos.edit', $v->id) }}" 
                                               class="btn btn-warning btn-sm">Edit</a>

                                            <a onclick="return confirm('Delete this video?')" 
                                               href="{{ route('admins.training-videos.delete', $v->id) }}"
                                               class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{ $videos->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
