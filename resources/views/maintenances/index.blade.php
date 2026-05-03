@extends('layouts.app')
@section('title', 'Maintenance')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0 fw-semibold">Suivi Maintenance</h5>
        <small class="text-muted">
            Total: <strong>{{ number_format($maintenances->sum('cost'), 2) }} MAD</strong>
        </small>
    </div>
    <a href="{{ route('maintenances.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Nouvelle maintenance
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Camion</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Coût (MAD)</th>
                    <th>Description</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenances as $m)
                <tr>
                    <td class="fw-medium">{{ $m->truck->matricule }}</td>
                    <td>{{ ucfirst($m->type) }}</td>
                    <td>{{ \Carbon\Carbon::parse($m->date)->format('d/m/Y') }}</td>
                    <td class="fw-medium text-danger">{{ number_format($m->cost, 2) }}</td>
                    <td>{{ $m->description ?? '—' }}</td>
                    <td class="text-end">
                        <a href="{{ route('maintenances.edit', $m) }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('maintenances.destroy', $m) }}"
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
                    <td colspan="6" class="text-center text-muted py-4">
                        Aucune maintenance enregistrée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($maintenances->hasPages())
    <div class="card-footer bg-white border-top-0">
        {{ $maintenances->links() }}
    </div>
    @endif
</div>
@endsection