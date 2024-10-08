@extends('member._elements.layout')

@section('title', 'Mon profil')


@section('content')


@include('member.account._elements.edit_header')


{{-- Page content --}}
<div class="card border border-4 border-primary">

    

     {{-- Content Header --}}
     <div class="card-header border-bottom border-primary flex-column align-items-start p-4">
        <div class="card-title d-flex justify-content-between w-100 align-items-center">
            <h4 class="mb-0">
                Modifiez vos informations
            </h4>
        </div>
        <div class="card-description">
            <p class="text-muted  mb-0 font-weight-light">
                Depuis cet espace, vous pouvez modifier vos informations.
            </p>
        </div>
    </div>
    {{-- /Content Header --}}


    {{-- Content Body --}}
    <div class="card-body">

       
        <form action="{{ route('member.account.update') }}" method="post">
            @csrf
    
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Prénom</label>
                        <input 
                            type="text" 
                            class="form-control @error('firstname') is-invalid @enderror" 
                            id="firstname" 
                            name="firstname" 
                            placeholder="Entrez votre prénom" 
                            autofocus 
                            required 
                            value="{{ $member->firstname }}"
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Nom</label>
                        <input 
                            type="text" 
                            class="form-control @error('lastname') is-invalid @enderror" 
                            id="lastname" 
                            name="lastname" 
                            placeholder="Entrez votre nom"
                            required 
                            value="{{ $member->lastname }}"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input 
                            type="text" 
                            class="form-control @error('phone') is-invalid @enderror" 
                            id="phone" 
                            name="phone" 
                            placeholder="Entrez votre numéro de téléphone" 
                            required 
                            value="{{ $member->phone }}"
                        >
                    </div>
                </div>
                <div class="col">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Entrez votre e-mail" 
                        required 
                        value="{{ $member->email }}"
                    >
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 form-group position-relative">
                        <label for="address" class="form-label">Adresse</label>
                        <input 
                            type="text" 
                            class="form-control @error('address') is-invalid @enderror" 
                            id="address" 
                            name="address" 
                            placeholder="Entrez votre adresse" 
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
                        <label for="city" class="form-label">Ville</label>
                        <input 
                            type="text" 
                            class="form-control @error('city') is-invalid @enderror" 
                            id="city" 
                            name="city" 
                            placeholder="Entrez votre ville" 
                            required 
                            value="{{ $member->city }}"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Code postal</label>
                        <input 
                            type="text" 
                            class="form-control @error('postal_code') is-invalid @enderror" 
                            id="postal_code" 
                            name="postal_code" 
                            placeholder="Entrez votre code postal" 
                            required 
                            value="{{ $member->postal_code }}"
                        >
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="country" class="form-label">Pays</label>
                        <input 
                            type="text" 
                            class="form-control @error('pays') is-invalid @enderror" 
                            id="country" 
                            name="country" 
                            placeholder="Entrez votre pays" 
                            required 
                            value="{{ $member->country }}"
                        >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="address_complement" class="form-label">Complément d'adresse (facultatif)</label>
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

            
            <div class="d-grid gap-2 mt-2">
                <button type="submit" class="btn btn-primary w-100 mb-2">
                    <span>
                        Modifier vos informations
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

