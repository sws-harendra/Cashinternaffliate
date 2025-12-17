<div class="form-group">
    <label>City <span class="text-danger">*</span></label>
    <input type="text"
           name="city"
           class="form-control"
           value="{{ old('city', $jobLocation->city ?? '') }}"
           required>
</div>

<div class="form-group">
    <label>State <span class="text-danger">*</span></label>
    <input type="text"
           name="state"
           class="form-control"
           value="{{ old('state', $jobLocation->state ?? '') }}"
           required>
</div>

<div class="form-group">
    <label>Country</label>
    <input type="text"
           name="country"
           class="form-control"
           value="{{ old('country', $jobLocation->country ?? 'India') }}">
</div>

<div class="form-group">
    <label>Status</label>
    <select name="is_active" class="form-control">
        <option value="1"
            {{ old('is_active', $jobLocation->is_active ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0"
            {{ old('is_active', $jobLocation->is_active ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>
