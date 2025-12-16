@extends('backend.admins.layouts.base')

@push('title')
    <title>Recruiters | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Recruiters</h5>
                        <p class="m-b-0">Manage all recruiters</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Recruiters</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-block table-responsive">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Recruiter</th>
                    <th>Company</th>
                    <th>Verification</th>
                    <th>Account Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @forelse($recruiters as $r)
                    <tr>
                        <td>{{ $r->id }}</td>

                        <td>
                            <strong>{{ $r->name }}</strong><br>
                            <small>{{ $r->email }}</small><br>
                            <small>{{ $r->mobile }}</small>
                        </td>

                        <td>
                            {{ $r->profile->industry ?? 'N/A' }}<br>
                            <small>
                                {{ $r->profile->company_size ?? '' }}
                            </small>
                        </td>

                        <td>
                            @if(!$r->verification)
                                <span class="badge badge-secondary">Not Uploaded</span>
                            @elseif($r->verification->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($r->verification->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @else
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>

                        <td>
                            @if($r->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admins.recruiters.show',$r->id) }}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>

                            <form method="POST"
                                  action="{{ route('admins.recruiters.toggle',$r->id) }}"
                                  class="d-inline">
                                @csrf
                                <button class="btn btn-sm
                                    {{ $r->is_active ? 'btn-danger' : 'btn-success' }}">
                                    {{ $r->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No recruiters found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $recruiters->links() }}
        </div>
    </div>

</div>
@endsection
