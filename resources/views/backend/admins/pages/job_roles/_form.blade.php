<div class="form-group">
    <label>Job Category <span class="text-danger">*</span></label>
    <select name="job_category_id" class="form-control" required>
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('job_category_id', $jobRole->job_category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Role Name <span class="text-danger">*</span></label>
    <input type="text"
           name="name"
           class="form-control"
           value="{{ old('name', $jobRole->name ?? '') }}"
           placeholder="e.g. PHP Developer, Sales Executive"
           required>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="is_active" class="form-control">
        <option value="1"
            {{ old('is_active', $jobRole->is_active ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0"
            {{ old('is_active', $jobRole->is_active ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>
