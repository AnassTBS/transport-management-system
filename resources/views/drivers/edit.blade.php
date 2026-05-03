@extends('layouts.app')
@section('title', 'Modifier chauffeur')

@section('content')
<div class="page-header">
    <h5 class="mb-0 fw-semibold">
        <i class="bi bi-person-badge me-2"></i>Modifier chauffeur — {{ $driver->nom }}
    </h5>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body p-4">
        <form action="{{ route('drivers.update', $driver) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-medium">Nom complet</label>
                <input type="text" name="nom"
                       class="form-control @error('nom') is-invalid @enderror"
                       value="{{ old('nom', $driver->nom) }}">
                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Téléphone</label>
                <input type="text" name="tel"
                       class="form-control @error('tel') is-invalid @enderror"
                       value="{{ old('tel', $driver->tel) }}">
                @error('tel') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">N° Permis</label>
                    <input type="text" name="permis"
                           class="form-control @error('permis') is-invalid @enderror"
                           value="{{ old('permis', $driver->permis) }}">
                    @error('permis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Status</label>
                    <select name="status" class="form-select">
                        @foreach(['actif', 'inactif'] as $status)
                            <option value="{{ $status }}"
                                {{ $driver->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('drivers.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection