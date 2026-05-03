{{-- resources/views/trucks/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Nouveau camion')

@section('content')
<div class="page-header">
    <h5 class="mb-0 fw-semibold">
        <i class="bi bi-truck me-2"></i>Nouveau camion
    </h5>
</div>

<div class="card shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <form action="{{ route('trucks.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">Matricule</label>
                <input type="text" name="matricule"
                       class="form-control @error('matricule') is-invalid @enderror"
                       value="{{ old('matricule') }}" placeholder="ex: 12345-A-1">
                @error('matricule')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Marque</label>
                <input type="text" name="marque"
                       class="form-control @error('marque') is-invalid @enderror"
                       value="{{ old('marque') }}" placeholder="Mercedes, Volvo...">
                @error('marque')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Année</label>
                    <input type="number" name="annee"
                           class="form-control @error('annee') is-invalid @enderror"
                           value="{{ old('annee', date('Y')) }}" min="2000">
                    @error('annee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Status</label>
                    <select name="status" class="form-select">
                        <option value="disponible">Disponible</option>
                        <option value="en_route">En route</option>
                        <option value="en_maintenance">En maintenance</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Enregistrer
                </button>
                <a href="{{ route('trucks.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection