
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettre à jour les informations personnelles et professionnelles de votre compte.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nom et Prénoms --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="nom" value="Nom" />
                <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $user->nom)" required />
                <x-input-error class="mt-2" :messages="$errors->get('nom')" />
            </div>

            <div>
                <x-input-label for="prenoms" value="Prénoms" />
                <x-text-input id="prenoms" name="prenoms" type="text" class="mt-1 block w-full" :value="old('prenoms', $user->prenoms)" />
                <x-input-error class="mt-2" :messages="$errors->get('prenoms')" />
            </div>
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        {{-- Genre, Téléphone --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="genre" value="Genre" />
                <select id="genre" name="genre" class="mt-1 block w-full rounded">
                    <option value="">-- Choisir --</option>
                    <option value="Homme" @selected($user->genre === 'Homme')>Homme</option>
                    <option value="Femme" @selected($user->genre === 'Femme')>Femme</option>
                    <option value="Autre" @selected($user->genre === 'Autre')>Autre</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('genre')" />
            </div>

            <div>
                <x-input-label for="telephone" value="Téléphone" />
                <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $user->telephone)" />
                <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
            </div>
        </div>

        {{-- Adresse et Date de naissance --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="adresse" value="Adresse" />
                <textarea id="adresse" name="adresse" rows="2" class="mt-1 block w-full rounded">{{ old('adresse', $user->adresse) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
            </div>

            <div>
                <x-input-label for="date_naissance" value="Date de naissance" />
                <x-text-input id="date_naissance" name="date_naissance" type="date" class="mt-1 block w-full" :value="old('date_naissance', $user->date_naissance)" />
                <x-input-error class="mt-2" :messages="$errors->get('date_naissance')" />
            </div>
        </div>

        {{-- Poste, Département, Date d’embauche --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="poste" value="Poste" />
                <x-text-input id="poste" name="poste" type="text" class="mt-1 block w-full" :value="old('poste', $user->poste)" />
                <x-input-error class="mt-2" :messages="$errors->get('poste')" />
            </div>

            <div>
                <x-input-label for="departement" value="Département" />
                <x-text-input id="departement" name="departement" type="text" class="mt-1 block w-full" :value="old('departement', $user->departement)" />
                <x-input-error class="mt-2" :messages="$errors->get('departement')" />
            </div>

            <div>
                <x-input-label for="date_embauche" value="Date d'embauche" />
                <x-text-input id="date_embauche" name="date_embauche" type="date" class="mt-1 block w-full" :value="old('date_embauche', $user->date_embauche)" />
                <x-input-error class="mt-2" :messages="$errors->get('date_embauche')" />
            </div>
        </div>

        {{-- Photo --}}
        <div>
            <x-input-label for="photo_profil" value="Photo de profil" />
            <input type="file" name="photo_profil" class="mt-1 block w-full" />
            @if($user->photo_profil)
                <img src="{{ asset('storage/' . $user->photo_profil) }}" class="h-16 mt-2 rounded-full">
            @endif
            <x-input-error class="mt-2" :messages="$errors->get('photo_profil')" />
        </div>

        {{-- Bouton --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400">
                    {{ __('Informations enregistrées.') }}
                </p>
            @endif
        </div>
    </form>
</section>
