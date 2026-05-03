@extends('layouts.app')
@section('title', 'Nouveau plein')

@section('content')
<div class="page-header">
    <h5 class="mb-0 fw-semibold">
        <i class="bi bi-fuel-pump me-2"></i>Nouveau plein carburant
    </h5>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body p-4">
        <form action="{{ route('fuels.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">Camion</label>
                <select name="truck_id" class="form-select @error('truck_id') is-invalid @enderror">
                    <option value="">-- Sélectionner --</option>
                    @foreach($trucks as $truck)
                        <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                            {{ $truck->matricule }} — {{ $truck->marque }}
                        </option>
                    @endforeach
                </select>
                @error('truck_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Quantité (litres)</label>
                    <input type="number" name="quantity" step="0.1"
                           class="form-control @error('quantity') is-invalid @enderror"
                           value="{{ old('quantity') }}" placeholder="50.0">
                    @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Coût total (MAD)</label>
                    <input type="number" name="cost" step="0.01"
                           class="form-control @error('cost') is-invalid @enderror"
                           value="{{ old('cost') }}" placeholder="0.00">
                    @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Date</label>
                    <input type="date" name="date"
                           class="form-control"
                           value="{{ old('date', date('Y-m-d')) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Station</label>
                    <input type="text" name="station"
                           class="form-control"
                           value="{{ old('station') }}" placeholder="Nom de la station">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Enregistrer
                </button>
                <a href="{{ route('fuels.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection