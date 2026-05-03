{{-- resources/views/deliveries/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Livraisons')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h5 class="mb-0 fw-semibold">Livraisons</h5>
        <small class="text-muted">{{ $deliveries->total() }} livraison(s)</small>
    </div>
    <a href="{{ route('deliveries.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Nouvelle livraison
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Camion</th>
                    <th>Chauffeur</th>
                    <th>Destination</th>
                    <th>Départ</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deliveries as $delivery)
                <tr>
                    <td class="fw-medium">{{ $delivery->truck->matricule }}</td>
                    <td>{{ $delivery->driver->nom }}</td>
                    <td>{{ $delivery->destination }}</td>
                    <td>{{ \Carbon\Carbon::parse($delivery->date_depart)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $badgeClass = match($delivery->status) {
                                'en_cours' => 'badge-en_cours',
                                'livree'   => 'badge-livree',
                                'annulee'  => 'badge-annulee',
                                default    => 'bg-secondary text-white',
                            };
                        @endphp
                        <span class="badge rounded-pill px-3 py-1 {{ $badgeClass }}">
                            {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('deliveries.edit', $delivery) }}"
                           class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('deliveries.destroy', $delivery) }}"
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
                        Aucune livraison enregistrée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($deliveries->hasPages())
    <div class="card-footer bg-white border-top-0">
        {{ $deliveries->links() }}
    </div>
    @endif
</div>
@endsection