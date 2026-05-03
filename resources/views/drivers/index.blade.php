@extends('layouts.app')
@section('title', 'Chauffeurs')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0 fw-semibold">Gestion des Chauffeurs</h5>
        <small class="text-muted">{{ $drivers->total() }} chauffeur(s)</small>
    </div>
    <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Nouveau chauffeur
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Permis</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                <tr>
                    <td class="fw-medium">{{ $driver->nom }}</td>
                    <td>{{ $driver->tel }}</td>
                    <td>{{ $driver->permis }}</td>
                    <td>
                        <span class="badge rounded-pill px-3 py-1
                            {{ $driver->status === 'actif' ? 'badge-disponible' : 'badge-annulee' }}">
                            {{ ucfirst($driver->status) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('drivers.edit', $driver) }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('drivers.destroy', $driver) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce chauffeur ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Aucun chauffeur enregistré
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($drivers->hasPages())
    <div class="card-footer bg-white border-top-0">
        {{ $drivers->links() }}
    </div>
    @endif
</div>
@endsection