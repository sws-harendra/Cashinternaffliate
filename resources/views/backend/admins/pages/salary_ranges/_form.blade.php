<div class="form-group">
    <label>Salary Label <span class="text-danger">*</span></label>
    <input type="text"
           name="label"
           class="form-control"
           placeholder="e.g. ₹15,000 – ₹25,000"
           value="{{ old('label', $salaryRange->label ?? '') }}"
           required>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Min Salary (₹)</label>
            <input type="number"
                   name="min_salary"
                   class="form-control"
                   value="{{ old('min_salary', $salaryRange->min_salary ?? '') }}">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>Max Salary (₹)</label>
            <input type="number"
                   name="max_salary"
                   class="form-control"
                   value="{{ old('max_salary', $salaryRange->max_salary ?? '') }}">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="is_active" class="form-control">
        <option value="1"
            {{ old('is_active', $salaryRange->is_active ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0"
            {{ old('is_active', $salaryRange->is_active ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>
