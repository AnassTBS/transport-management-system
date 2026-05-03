@extends('layouts.app')
@section('title', 'Nouvelle livraison')

@section('content')
<div class="page-header">
    <h5 class="mb-0 fw-semibold">
        <i class="bi bi-box-seam me-2"></i>Nouvelle livraison
    </h5>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body p-4">
        <form action="{{ route('deliveries.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-medium">Camion</label>
                <select name="truck_id" class="form-select @error('truck_id') is-invalid @enderror">
                    <option value="">-- Sélectionner un camion --</option>
                    @foreach($trucks as $truck)
                        <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                            {{ $truck->matricule }} — {{ $truck->marque }}
                        </option>
                    @endforeach
                </select>
                @error('truck_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Chauffeur</label>
                <select name="driver_id" class="form-select @error('driver_id') is-invalid @enderror">
                    <option value="">-- Sélectionner un chauffeur --</option>
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                            {{ $driver->nom }}
                        </option>
                    @endforeach
                </select>
                @error('driver_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Destination</label>
                <input type="text" name="destination"
                       class="form-control @error('destination') is-invalid @enderror"
                       value="{{ old('destination') }}">
                @error('destination') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Date départ</label>
                    <input type="date" name="date_depart"
                           class="form-control @error('date_depart') is-invalid @enderror"
                           value="{{ old('date_depart', date('Y-m-d')) }}">
                    @error('date_depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Enregistrer
                </button>
                <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection