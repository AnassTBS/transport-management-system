@extends('layouts.app')
@section('title', 'Modifier maintenance')

@section('content')
<div class="page-header">
    <h5 class="mb-0 fw-semibold">
        <i class="bi bi-tools me-2"></i>Modifier maintenance #{{ $maintenance->id }}
    </h5>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body p-4">
        <form action="{{ route('maintenances.update', $maintenance) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-medium">Camion</label>
                <select name="truck_id" class="form-select @error('truck_id') is-invalid @enderror">
                    @foreach($trucks as $truck)
                        <option value="{{ $truck->id }}"
                            {{ $maintenance->truck_id == $truck->id ? 'selected' : '' }}>
                            {{ $truck->matricule }} — {{ $truck->marque }}
                        </option>
                    @endforeach
                </select>
                @error('truck_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Type</label>
                    <select name="type" class="form-select">
                        @foreach(['vidange', 'pneus', 'freins', 'moteur', 'autre'] as $type)
                            <option value="{{ $type }}"
                                {{ $maintenance->type === $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Date</label>
                    <input type="date" name="date"
                           class="form-control @error('date') is-invalid @enderror"
                           value="{{ old('date', $maintenance->date) }}">
                    @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Coût (MAD)</label>
                <input type="number" name="cost" step="0.01"
                       class="form-control @error('cost') is-invalid @enderror"
                       value="{{ old('cost', $maintenance->cost) }}" placeholder="0.00">
                @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Description</label>
                <textarea name="description" class="form-control" rows="2"
                          placeholder="Détails optionnels...">{{ old('description', $maintenance->description) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('maintenances.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection