{{-- resources/views/fuels/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Carburant')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0 fw-semibold">Suivi Carburant</h5>
        <small class="text-muted">Total: <strong>{{ number_format($fuels->sum('cost'), 2) }} MAD</strong></small>
    </div>
    <a href="{{ route('fuels.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Nouveau plein
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Camion</th>
                    <th>Date</th>
                    <th>Quantité (L)</th>
                    <th>Prix/L (MAD)</th>
                    <th>Coût total (MAD)</th>
                    <th>Station</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fuels as $fuel)
                <tr>
                    <td class="fw-medium">{{ $fuel->truck->matricule }}</td>
                    <td>{{ \Carbon\Carbon::parse($fuel->date)->format('d/m/Y') }}</td>
                    <td>{{ number_format($fuel->quantity, 1) }}</td>
                    <td>{{ number_format($fuel->price_per_litre, 2) }}</td>
                    <td class="fw-medium text-danger">{{ number_format($fuel->cost, 2) }}</td>
                    <td>{{ $fuel->station ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('fuels.edit', $fuel) }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('fuels.destroy', $fuel) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Aucune consommation enregistrée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection