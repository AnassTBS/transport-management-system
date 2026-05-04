{{-- resources/views/trucks/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Camions')

@section('styles')
<style>
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeInUp 0.5s ease-out forwards; opacity: 0; }
    
    /* Page Header */
    .page-header-modern {
        background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
        border-radius: 20px;
        padding: 2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.2);
        position: relative;
        overflow: hidden;
    }
    .page-header-modern::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('data:image/svg+xml;utf8,<svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.15)"/></svg>') repeat;
        opacity: 0.8;
    }
    .page-header-content { position: relative; z-index: 2; }
    
    /* Modern Button */
    .btn-modern {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(8px);
        padding: 0.6rem 1.2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-modern:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.03);
        overflow: hidden;
    }

    /* Modern Table */
    .table-modern {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-modern th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        font-weight: 600;
        padding: 1.25rem 1rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-modern td {
        padding: 1rem;
        vertical-align: middle;
        color: #334155;
        font-weight: 500;
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.2s;
    }
    .table-modern tbody tr:hover td { background: #f8fafc; }
    .table-modern tbody tr:last-child td { border-bottom: none; }

    /* Modern Badges */
    .modern-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .badge-success { background: rgba(16, 185, 129, 0.1); color: #059669; }
    .badge-primary { background: rgba(14, 165, 233, 0.1); color: #0284c7; }
    .badge-warning { background: rgba(245, 158, 11, 0.1); color: #d97706; }
    .badge-secondary { background: rgba(100, 116, 139, 0.1); color: #475569; }
    
    /* Actions Button */
    .btn-action {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .btn-edit { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; border: none; }
    .btn-edit:hover { background: #0ea5e9; color: white; transform: translateY(-2px); }
    .btn-delete { background: rgba(239, 68, 68, 0.1); color: #ef4444; border: none; }
    .btn-delete:hover { background: #ef4444; color: white; transform: translateY(-2px); }
    
    /* Pagination */
    .pagination-wrapper { padding: 1.5rem; background: white; border-top: 1px solid #e2e8f0; }
</style>
@endsection

@section('content')
<div class="page-header-modern animate-fade-in d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div class="page-header-content">
        <h2 class="mb-1 fw-bold">Gestion des Camions</h2>
        <p class="mb-0 text-white-50"><i class="bi bi-truck me-2"></i>{{ $trucks->total() }} camion(s) enregistré(s) dans la flotte</p>
    </div>
    <div class="page-header-content">
        <a href="{{ route('trucks.create') }}" class="btn-modern text-decoration-none">
            <i class="bi bi-plus-lg me-1"></i> Nouveau camion
        </a>
    </div>
</div>

<div class="content-card animate-fade-in" style="animation-delay: 0.1s;">
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th class="ps-4">Matricule</th>
                    <th>Marque</th>
                    <th>Année</th>
                    <th>Status</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trucks as $truck)
                <tr>
                    <td class="ps-4 fw-bold text-dark">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light rounded p-2 text-primary">
                                <i class="bi bi-truck"></i>
                            </div>
                            {{ $truck->matricule }}
                        </div>
                    </td>
                    <td>{{ $truck->marque }}</td>
                    <td><span class="text-muted">{{ $truck->annee }}</span></td>
                    <td>
                        @php
                            $badgeData = match($truck->status) {
                                'disponible'     => ['class' => 'badge-success', 'icon' => 'bi-check-circle-fill'],
                                'en_route'       => ['class' => 'badge-primary', 'icon' => 'bi-arrow-right-circle-fill'],
                                'en_maintenance' => ['class' => 'badge-warning', 'icon' => 'bi-tools'],
                                default          => ['class' => 'badge-secondary', 'icon' => 'bi-info-circle-fill'],
                            };
                        @endphp
                        <span class="modern-badge {{ $badgeData['class'] }}">
                            <i class="bi {{ $badgeData['icon'] }}"></i> {{ ucfirst(str_replace('_', ' ', $truck->status)) }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <a href="{{ route('trucks.edit', $truck) }}" class="btn-action btn-edit me-1" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('trucks.destroy', $truck) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce camion ?')">
                            @csrf @method('DELETE')
                            <button class="btn-action btn-delete" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <i class="bi bi-inbox fs-1 text-black-50 mb-3"></i>
                            <h5>Aucun camion enregistré</h5>
                            <p class="text-muted">Commencez par ajouter un nouveau camion à la flotte.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($trucks->hasPages())
    <div class="pagination-wrapper">
        {{ $trucks->links() }}
    </div>
    @endif
</div>
@endsection