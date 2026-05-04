{{-- resources/views/trucks/create.blade.php --}}
@extends('layouts.app')
@section('title', 'Nouveau camion')

@section('styles')
<style>
    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeInUp 0.5s ease-out forwards; opacity: 0; }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: 24px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.04);
        overflow: hidden;
        max-width: 650px;
        margin: 0 auto;
    }
    .card-header-modern {
        background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
        padding: 2rem;
        color: white;
        text-align: center;
    }
    .card-header-modern h4 { font-weight: 700; margin-bottom: 0; }
    
    /* Modern Form Inputs */
    .form-modern .form-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    .form-modern .form-control, .form-modern .form-select {
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        color: #334155;
        transition: all 0.2s;
        background-color: #f8fafc;
    }
    .form-modern .form-control:focus, .form-modern .form-select:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        background-color: #ffffff;
    }
    
    /* Modern Buttons */
    .btn-submit {
        background: linear-gradient(135deg, #0ea5e9 0%, #4f46e5 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        color: white;
    }
    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #e2e8f0; color: #334155; }
</style>
@endsection

@section('content')
<div class="py-4 animate-fade-in">
    <div class="content-card">
        <div class="card-header-modern">
            <div class="mb-3 d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 16px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);">
                <i class="bi bi-truck fs-2"></i>
            </div>
            <h4>Ajouter un Nouveau Camion</h4>
            <p class="text-white-50 mb-0 mt-2">Veuillez renseigner les informations du véhicule</p>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('trucks.store') }}" method="POST" class="form-modern">
                @csrf

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-hash me-1"></i> Matricule</label>
                    <input type="text" name="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule') }}" placeholder="ex: 12345-A-1">
                    @error('matricule') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-tag-fill me-1"></i> Marque</label>
                    <input type="text" name="marque" class="form-control @error('marque') is-invalid @enderror" value="{{ old('marque') }}" placeholder="ex: Mercedes, Volvo...">
                    @error('marque') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-calendar-event me-1"></i> Année</label>
                        <input type="number" name="annee" class="form-control @error('annee') is-invalid @enderror" value="{{ old('annee', date('Y')) }}" min="2000">
                        @error('annee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-activity me-1"></i> Status</label>
                        <select name="status" class="form-select">
                            <option value="disponible">Disponible</option>
                            <option value="en_route">En route</option>
                            <option value="en_maintenance">En maintenance</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-3 pt-3 mt-2 border-top">
                    <button type="submit" class="btn-submit flex-grow-1">
                        <i class="bi bi-check-lg me-1"></i> Enregistrer
                    </button>
                    <a href="{{ route('trucks.index') }}" class="btn-cancel text-decoration-none text-center px-4">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection