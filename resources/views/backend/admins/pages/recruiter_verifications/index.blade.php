@extends('backend.admins.layouts.base')

@push('title')
    <title>Recruiter Verifications | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Recruiter Verifications</h5>
                        <p class="m-b-0">Manage recruiter document verification</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Recruiter Verifications</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-block table-responsive">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Recruiter</th>
                        <th>Email</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($verifications as $v)
                    <tr>
                        <td>{{ $v->id }}</td>
                        <td>{{ $v->recruiter->name }}</td>
                        <td>{{ $v->recruiter->email }}</td>
                        <td>{{ $v->document_type }}</td>

                        <td>
                            @if($v->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($v->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @else
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </td>

                        <td>{{ $v->created_at->format('d M Y') }}</td>

                        <td>
                            <a href="{{ route('admins.recruiter.verifications.show', $v->id) }}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No recruiter verification records found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $verifications->links() }}

        </div>
    </div>

</div>
@endsection
