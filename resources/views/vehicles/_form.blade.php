<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model', $vehicle?->model) }}" placeholder="e.g. 911 Carrera" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Year</label>
        <input type="number" name="year" class="form-control" value="{{ old('year', $vehicle?->year) }}" min="1900" max="{{ date('Y')+1 }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Type</label>
        <select name="type" class="form-select" required>
            @foreach(['Sedan','SUV','Coupe','Convertible','Wagon','Hatchback'] as $type)
            <option value="{{ $type }}" {{ old('type', $vehicle?->type) === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Color</label>
        <input type="text" name="color" class="form-control" value="{{ old('color', $vehicle?->color) }}" placeholder="e.g. Guards Red" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Plate Number</label>
        <input type="text" name="plate_number" class="form-control" value="{{ old('plate_number', $vehicle?->plate_number) }}" placeholder="e.g. ABC 1234" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Price (₱)</label>
        <input type="number" name="price" class="form-control" value="{{ old('price', $vehicle?->price) }}" step="0.01" min="0" placeholder="Optional">
    </div>
    <div class="col-12">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control" rows="2" placeholder="Optional notes...">{{ old('notes', $vehicle?->notes) }}</textarea>
    </div>
</div>
