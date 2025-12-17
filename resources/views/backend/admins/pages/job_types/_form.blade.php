<div class="form-group">
    <label>Job Type <span class="text-danger">*</span></label>
    <input type="text"
           name="name"
           class="form-control"
           placeholder="e.g. Full Time, Part Time, Internship"
           value="{{ old('name', $jobType->name ?? '') }}"
           required>
</div>
{{-- 
<div class="form-group">
    <label>Status</label>
    <select name="is_active" class="form-control">
        <option value="1"
            {{ old('is_active', $jobType->is_active ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0"
            {{ old('is_active', $jobType->is_active ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div> --}}
