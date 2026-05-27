@extends('layouts.app')
@section('page-title', 'My Vehicles')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-car-front me-2" style="color:var(--porsche-red);"></i>Vehicle Records</span>
        <button class="btn btn-porsche btn-sm" data-bs-toggle="modal" data-bs-target="#addVehicleModal">
            <i class="bi bi-plus-lg me-1"></i> Add Vehicle
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Model</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Color</th>
                        <th>Plate No.</th>
                        <th>Price</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicles as $v)
                    <tr>
                        <td class="ps-3 text-muted" style="font-size:0.8rem;">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $v->model }}</td>
                        <td>
                            @php
                                $colors = ['Sedan'=>'primary','SUV'=>'success','Coupe'=>'danger','Convertible'=>'warning','Wagon'=>'info','Hatchback'=>'secondary'];
                            @endphp
                            <span class="badge badge-type bg-{{ $colors[$v->type] ?? 'secondary' }}">{{ $v->type }}</span>
                        </td>
                        <td>{{ $v->year }}</td>
                        <td>{{ $v->color }}</td>
                        <td><code>{{ $v->plate_number }}</code></td>
                        <td>{{ $v->price ? '₱' . number_format($v->price, 2) : '—' }}</td>
                        <td class="text-end pe-3">
                            <button class="btn btn-sm btn-outline-secondary"
                                data-bs-toggle="modal" data-bs-target="#editVehicleModal{{ $v->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form method="POST" action="{{ route('vehicles.destroy', $v) }}" class="d-inline"
                                onsubmit="return confirm('Delete this vehicle record?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editVehicleModal{{ $v->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h6 class="modal-title fw-bold">Edit Vehicle</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="{{ route('vehicles.update', $v) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        @include('vehicles._form', ['vehicle' => $v])
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-porsche">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No vehicle records yet. Add your first one!</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Vehicle Modal --}}
<div class="modal fade" id="addVehicleModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h6 class="modal-title fw-bold">Add Vehicle Record</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('vehicles.store') }}">
                @csrf
                <div class="modal-body">
                    @if($errors->any())
                    <div class="alert alert-danger py-2" style="font-size:0.85rem;">{{ $errors->first() }}</div>
                    @endif
                    @include('vehicles._form', ['vehicle' => null])
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-porsche">Add Vehicle</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    @if($errors->any())
        new bootstrap.Modal(document.getElementById('addVehicleModal')).show();
    @endif
</script>
@endpush
@endsection
