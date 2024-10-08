@extends('admin._elements.layout')

@section('title', 'Modifier ' . $member->firstname . ' ' . $member->lastname)


@section('content')

{{-- Page Header --}}
@include('admin.members._elements.edit_header')
{{-- /Page Header --}}



{{-- Page content --}}
<div class="card border border-4 border-primary">



    {{-- Content Header --}}
    <div class="card-header border-bottom border-primary flex-column align-items-start p-4">
        <div class="card-title d-flex justify-content-between w-100 align-items-center">
            <h4 class="mb-0">
                Les informations {{ $member->firstname }} {{ $member->lastname }}
            </h4>
        </div>
        <div class="card-description">
            <p class="text-muted  mb-0 font-weight-light">
                Depuis cet espace, vous avez la possibilité de modifier les informations du membre.
            </p>
        </div>
    </div>
    {{-- /Content Header --}}


    {{-- Content Body --}}
    <div class="card-body">

      

        <form action="{{ route('admin.members.update', ['user' => $member]) }}" method="post">
            @csrf
    
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">
                            Prénom
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('firstname') is-invalid @enderror" 
                            id="firstname" 
                            name="firstname" 
                            placeholder="Entrez le prénom" 
                            autofocus 
                            required 
                            value="{{ $member->firstname }}"
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">
                            Nom
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('lastname') is-invalid @enderror" 
                            id="lastname" 
                            name="lastname" 
                            placeholder="Entrez le nom"
                            required 
                            value="{{ $member->lastname }}"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="phone" class="form-label">
                            Téléphone
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('phone') is-invalid @enderror" 
                            id="phone" 
                            name="phone" 
                            placeholder="Entrez le numéro de téléphone" 
                            required 
                            value="{{ $member->phone }}"
                        >
                    </div>
                </div>
                <div class="col">
                    <label for="email" class="form-label">
                        Adresse e-mail
                        <span class="text-muted">
                            *
                        </span>
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Entrez l'e-mail" 
                        required 
                        value="{{ $member->email }}"
                    >
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 form-group position-relative">
                        <label for="address" class="form-label">
                            Adresse
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('address') is-invalid @enderror" 
                            id="address" 
                            name="address" 
                            placeholder="Entrez l'adresse" 
                            required 
                            value="{{ $member->address }}"
                        >
                        {{-- <div class="dropdown-menu w-100" id="search-results">
                            <li class="dropdown-item loading">Chargement...</li>
                        </div> --}}
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="city" class="form-label">
                            Ville
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('city') is-invalid @enderror" 
                            id="city" 
                            name="city" 
                            placeholder="Entrez la ville" 
                            required 
                            value="{{ $member->city }}"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">
                            Code postal
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('postal_code') is-invalid @enderror" 
                            id="postal_code" 
                            name="postal_code" 
                            placeholder="Entrez le code postal" 
                            required 
                            value="{{ $member->postal_code }}"
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="country" class="form-label">
                            Pays
                            <span class="text-muted">
                                *
                            </span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('pays') is-invalid @enderror" 
                            id="country" 
                            name="country" 
                            placeholder="Entrez le pays" 
                            required 
                            value="{{ $member->country }}"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="address_complement fw-light" class="form-label">
                            Complément d'adresse
                            <span class="text-muted">
                                (facultatif)
                            </span>
                        </label>
                        <textarea 
                            class="form-control @error('address_complement') is-invalid @enderror" 
                            name="address_complement" 
                            id="address_complement" 
                            rows="2" 
                            style="resize: none;" 
                            placeholder="Entrez ou non un complément d'adresse"
                        >{{ $member->address_complement }}</textarea>
                    </div>
                </div> 
                
            </div>

            <div class="row">
                <div class="col d-flex align-items-center">
                    <div class="custom-control custom-switch  mb-3">
                        <input type="hidden" name="email_verified" value="0">
                        <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            id="email_verified" 
                            name="email_verified"
                            value="1"
                            {{ $member->email_verified_at ? 'checked' : '' }}
                        >
                        <label class="custom-control-label" for="email_verified">Vérifier l'adresse e-mail ?</label>
                        <div class="text-muted font-weight-light">
                            En cochant cette case, le membre n'aura pas à vérifier son adresse e-mail.
                        </div>
                    </div>
                </div>

                <div class="col d-flex align-items-center">
                    <div class="custom-control custom-switch  mb-3">
                        <input type="hidden" name="first_session" value="0">
                        <input 
                            type="checkbox" 
                            class="custom-control-input" 
                            id="first_session" 
                            name="first_session"
                            value="1"
                            {{ $member->first_session ? 'checked' : '' }}
                        >
                        <label class="custom-control-label" for="first_session">Première séance ?</label>
                        <div class="text-muted font-weight-light">
                            En cochant cette case, le membre a accès à sa première séance gratuite.
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-primary w-100 mb-2">
                    <span>
                        Modifier les informations
                    </span>
                    <i class="fas fa-user-edit ms-2"></i>
                </button>
            </div>
        </form>


            

    </div>
    {{-- /Content Body --}}
</div>
{{-- /Page content --}}


@endsection

@section('scripts')
    @vite('resources/js/plugins/filepond.js')
@endsection

