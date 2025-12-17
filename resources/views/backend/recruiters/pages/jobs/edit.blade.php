@extends('backend.recruiters.layouts.base')

@push('title')
    <title>Edit Job | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Job</h5>
                        <p class="m-b-0 text-warning">
                            Editing this job will send it again for admin approval
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.recruiters.partials.alerts')

    <div class="card">
        <div class="card-block">

            {{-- अगर job approved है तो edit बंद --}}
            @if($job->status === 'approved')
                <div class="alert alert-info">
                    This job is already approved and cannot be edited.
                </div>
            @else

            <form method="POST" action="{{ route('recruiters.jobs.update', $job->id) }}">
                @csrf
                @method('PUT')

                {{-- Job Title --}}
                <div class="form-group">
                    <label>Job Title <span class="text-danger">*</span></label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $job->title) }}"
                           required>
                </div>

                {{-- Category + Role --}}
                <div class="row">
                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="job_category_id" class="form-control">
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}"
                                    {{ $job->job_category_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Role</label>
                        <select name="job_role_id" class="form-control">
                            @foreach($roles as $r)
                                <option value="{{ $r->id }}"
                                    {{ $job->job_role_id == $r->id ? 'selected' : '' }}>
                                    {{ $r->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Type + Location --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Job Type</label>
                        <select name="job_type_id" class="form-control">
                            @foreach($types as $t)
                                <option value="{{ $t->id }}"
                                    {{ $job->job_type_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Location</label>
                        <select name="job_location_id" class="form-control">
                            @foreach($locations as $l)
                                <option value="{{ $l->id }}"
                                    {{ $job->job_location_id == $l->id ? 'selected' : '' }}>
                                    {{ $l->city }}, {{ $l->state }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Experience + Salary --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label>Experience Level</label>
                        <select name="experience_level_id" class="form-control">
                            @foreach($experiences as $e)
                                <option value="{{ $e->id }}"
                                    {{ $job->experience_level_id == $e->id ? 'selected' : '' }}>
                                    {{ $e->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Salary Range</label>
                        <select name="salary_range_id" class="form-control">
                            <option value="">Not Disclosed</option>
                            @foreach($salaries as $s)
                                <option value="{{ $s->id }}"
                                    {{ $job->salary_range_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Description --}}
                <div class="form-group mt-3">
                    <label>Job Description <span class="text-danger">*</span></label>
                    <textarea name="description"
                              class="form-control"
                              rows="4"
                              required>{{ old('description', $job->description) }}</textarea>
                </div>

                {{-- Responsibilities --}}
                <div class="form-group">
                    <label>Responsibilities</label>
                    <textarea name="responsibilities"
                              class="form-control"
                              rows="3">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                </div>

                {{-- Skills --}}
                <div class="form-group">
                    <label>Skills (comma separated)</label>
                    <input type="text"
                           name="skills"
                           class="form-control"
                           value="{{ old('skills', $job->skills) }}">
                </div>

                {{-- Buttons --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Update & Send for Approval
                    </button>

                    <a href="{{ route('recruiters.jobs.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
            @endif
        </div>
    </div>

</div>
@endsection
