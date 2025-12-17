@extends('backend.recruiters.layouts.base')

@push('title')
<title>Post Job | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

@include('backend.recruiters.partials.alerts')

<div class="card">
    <div class="card-header">
        <h5>Post a New Job</h5>
        <span class="text-muted">Fill job details carefully</span>
    </div>

    <div class="card-block">
        <form method="POST" action="{{ route('recruiters.jobs.store') }}">
            @csrf

            <div class="form-group">
                <label>Job Title *</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Category</label>
                    <select name="job_category_id" class="form-control">
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Role</label>
                    <select name="job_role_id" class="form-control">
                        @foreach($roles as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>Job Type</label>
                    <select name="job_type_id" class="form-control">
                        @foreach($types as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Location</label>
                    <select name="job_location_id" class="form-control">
                        @foreach($locations as $l)
                            <option value="{{ $l->id }}">
                                {{ $l->city }}, {{ $l->state }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>Experience</label>
                    <select name="experience_level_id" class="form-control">
                        @foreach($experiences as $e)
                            <option value="{{ $e->id }}">{{ $e->label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Salary</label>
                    <select name="salary_range_id" class="form-control">
                        <option value="">Not Disclosed</option>
                        @foreach($salaries as $s)
                            <option value="{{ $s->id }}">{{ $s->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mt-2">
                <label>Description *</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label>Responsibilities</label>
                <textarea name="responsibilities" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label>Skills (comma separated)</label>
                <input type="text" name="skills" class="form-control">
            </div>

            <button class="btn btn-success mt-3">
                Submit for Approval
            </button>
        </form>
    </div>
</div>

</div>
@endsection
