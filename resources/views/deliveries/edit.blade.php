@extends('layouts.app')
@section('title', 'Modifier livraison')

@section('content')
<div class="page-header">
    <h5 class="mb-0 fw-semibold">
        <i class="bi bi-box-seam me-2"></i>Modifier livraison #{{ $delivery->id }}
    </h5>
</div>

<div class="card shadow-sm" style="max-width:600px">
    <div class="card-body p-4">
        <form action="{{ route('deliveries.update', $delivery) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-medium">Camion</label>
                <select name="truck_id" class="form-select @error('truck_id') is-invalid @enderror">
                    @foreach($trucks as $truck)
                        <option value="{{ $truck->id }}"
                            {{ $delivery->truck_id == $truck->id ? 'selected' : '' }}>
                            {{ $truck->matricule }} — {{ $truck->marque }}
                        </option>
                    @endforeach
                </select>
                @error('truck_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Chauffeur</label>
                <select name="driver_id" class="form-select @error('driver_id') is-invalid @enderror">
                    @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}"
                            {{ $delivery->driver_id == $driver->id ? 'selected' : '' }}>
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
                       value="{{ old('destination', $delivery->destination) }}">
                @error('destination') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Date départ</label>
                    <input type="date" name="date_depart"
                           class="form-control @error('date_depart') is-invalid @enderror"
                           value="{{ old('date_depart', $delivery->date_depart) }}">
                    @error('date_depart') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Date arrivée</label>
                    <input type="date" name="date_arrivee"
                           class="form-control"
                           value="{{ old('date_arrivee', $delivery->date_arrivee) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Status</label>
                <select name="status" class="form-select">
                    @foreach(['en_cours', 'livree', 'annulee'] as $status)
                        <option value="{{ $status }}"
                            {{ $delivery->status === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('deliveries.index') }}" class="btn btn-outline-secondary">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection