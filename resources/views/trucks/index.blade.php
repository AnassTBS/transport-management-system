{{-- resources/views/trucks/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Camions')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0 fw-semibold">Gestion des Camions</h5>
        <small class="text-muted">{{ $trucks->total() }} camion(s) enregistré(s)</small>
    </div>
    <a href="{{ route('trucks.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Nouveau camion
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Matricule</th>
                    <th>Marque</th>
                    <th>Année</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trucks as $truck)
                <tr>
                    <td class="fw-medium">{{ $truck->matricule }}</td>
                    <td>{{ $truck->marque }}</td>
                    <td>{{ $truck->annee }}</td>
                    <td>
                        @php
                            $badgeClass = match($truck->status) {
                                'disponible'     => 'badge-disponible',
                                'en_route'       => 'badge-en_route',
                                'en_maintenance' => 'badge-en_maint',
                                default          => 'bg-secondary text-white',
                            };
                        @endphp
                        <span class="badge rounded-pill px-3 py-1 {{ $badgeClass }}">
                            {{ ucfirst(str_replace('_', ' ', $truck->status)) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('trucks.edit', $truck) }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('trucks.destroy', $truck) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer ce camion ?')">
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
                        Aucun camion enregistré
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($trucks->hasPages())
    <div class="card-footer bg-white border-top-0">
        {{ $trucks->links() }}
    </div>
    @endif
</div>
@endsection