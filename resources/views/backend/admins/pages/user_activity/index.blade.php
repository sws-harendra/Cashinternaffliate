@extends('backend.admins.layouts.base')

@push('title')
<title>User Activity | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">User Activity</h5>
                        <p class="m-b-0">Track user app usage & behavior</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">User Activity</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="card">
                    <div class="card-header">
                        <h5>Activity Logs</h5>
                    </div>

                    <div class="card-block">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>Activity</th>
                                        <th>Screen</th>
                                        <th>Device</th>
                                        <th>App Version</th>
                                        <th>IP</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($activities as $i => $activity)
                                        <tr>
                                            <td>{{ $activities->firstItem() + $i }}</td>

                                            <td>
                                                {{ $activity->user->name ?? 'Guest' }} <br>
                                                <small class="text-muted">
                                                    {{ $activity->user_id }}
                                                </small>
                                            </td>

                                            <td>
                                                <span class="badge badge-info">
                                                    {{ ucfirst(str_replace('_', ' ', $activity->activity_type)) }}
                                                </span>
                                            </td>

                                            <td>{{ $activity->screen ?? '-' }}</td>

                                            <td>
                                                {{ $activity->device_type ?? '-' }} <br>
                                                <small>{{ $activity->device_id ?? '' }}</small>
                                            </td>

                                            <td>{{ $activity->app_version ?? '-' }}</td>

                                            <td>{{ $activity->ip ?? '-' }}</td>

                                            <td>{{ $activity->created_at->format('d M Y h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No activity found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $activities->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
