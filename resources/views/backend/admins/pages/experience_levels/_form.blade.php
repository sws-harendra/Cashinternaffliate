<div class="form-group">
    <label>Experience Level <span class="text-danger">*</span></label>
    <input type="text"
           name="label"
           class="form-control"
           placeholder="e.g. Fresher, 1–3 Years, 5+ Years"
           value="{{ old('label', $experienceLevel->label ?? '') }}"
           required>
</div>

{{-- <div class="form-group">
    <label>Status</label>
    <select name="is_active" class="form-control">
        <option value="1"
            {{ old('is_active', $experienceLevel->is_active ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>
        <option value="0"
            {{ old('is_active', $experienceLevel->is_active ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div> --}}
