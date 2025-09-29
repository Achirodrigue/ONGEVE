<x-guest-layout>
    <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- ÉTAPE 1 : Identité -->
        <div class="step" id="step1">
            <h2 class="text-lg font-bold mb-4">Étape 1 : Identité</h2>

            <!-- Nom -->
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" name="nom" type="text" class="block mt-1 w-full" required autofocus />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />

            <!-- Prénoms -->
            <x-input-label for="prenoms" class="mt-4" :value="__('Prénoms')" />
            <x-text-input id="prenoms" name="prenoms" type="text" class="block mt-1 w-full" />

            <!-- Email -->
            <x-input-label for="email" class="mt-4" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" required />
            
            <!-- Mot de passe -->
            <x-input-label for="password" class="mt-4" :value="__('Mot de passe')" />
            <x-text-input id="password" name="password" type="password" class="block mt-1 w-full" required />

            <!-- Confirmation -->
            <x-input-label for="password_confirmation" class="mt-4" :value="__('Confirmation mot de passe')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" required />

            <div class="mt-6 text-end">
                <button type="button" onclick="nextStep()" class="btn btn-primary">Suivant</button>
            </div>
        </div>

        <!-- ÉTAPE 2 : Profession -->
        <div class="step hidden" id="step2">
            <h2 class="text-lg font-bold mb-4">Étape 2 : Profession</h2>

            <!-- Rôle -->
            <x-input-label for="role" :value="__('Rôle')" />
            <select name="role" id="role" class="block mt-1 w-full" required>
                <option value="Employé" selected>Parcking</option>
                <option value="Manager">Manager</option>
                <option value="RH">RH</option>
                <option value="Administrateur">Administrateur</option>
                <option value="DG">DG</option>
            </select>

            <!-- Poste -->
            <x-input-label for="poste" class="mt-4" :value="__('Poste')" />
            <x-text-input id="poste" name="poste" type="text" class="block mt-1 w-full" />

            <!-- Département -->
            <x-input-label for="departement" class="mt-4" :value="__('Département')" />
            <x-text-input id="departement" name="departement" type="text" class="block mt-1 w-full" />

            <!-- Date embauche -->
            <x-input-label for="date_embauche" class="mt-4" :value="__('Date d\'embauche')" />
            <x-text-input id="date_embauche" name="date_embauche" type="date" class="block mt-1 w-full" />

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="prevStep()" class="btn btn-secondary">Retour</button>
                <button type="button" onclick="nextStep()" class="btn btn-primary">Suivant</button>
            </div>
        </div>

        <!-- ÉTAPE 3 : Infos perso -->
        <div class="step hidden" id="step3">
            <h2 class="text-lg font-bold mb-4">Étape 3 : Informations personnelles</h2>

            <!-- Genre -->
            <x-input-label for="genre" :value="__('Genre')" />
            <select id="genre" name="genre" class="block mt-1 w-full">
                <option value="">-- Sélectionner --</option>
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autre">Autre</option>
            </select>

            <!-- Téléphone -->
            <x-input-label for="telephone" class="mt-4" :value="__('Téléphone')" />
            <x-text-input id="telephone" name="telephone" type="text" class="block mt-1 w-full" />

            <!-- Adresse -->
            <x-input-label for="adresse" class="mt-4" :value="__('Adresse')" />
            <textarea id="adresse" name="adresse" class="block mt-1 w-full">{{ old('adresse') }}</textarea>

            <!-- Date naissance -->
            <x-input-label for="date_naissance" class="mt-4" :value="__('Date de naissance')" />
            <x-text-input id="date_naissance" name="date_naissance" type="date" class="block mt-1 w-full" />

            <!-- Photo -->
            <x-input-label for="photo_profil" class="mt-4" :value="__('Photo de profil')" />
            <x-text-input id="photo_profil" name="photo_profil" type="file" class="block mt-1 w-full" />

            <div class="mt-6 flex justify-between">
                <button type="button" onclick="prevStep()" class="btn btn-secondary">Retour</button>
                <x-primary-button>S'inscrire</x-primary-button>
            </div>
        </div>
    </form>

    <script>
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('.step').forEach((el, index) => {
                el.classList.add('hidden');
            });
            document.getElementById('step' + step).classList.remove('hidden');
            currentStep = step;
        }

        function nextStep() {
            if (currentStep < 3) {
                showStep(currentStep + 1);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        // Au chargement de la page
        document.addEventListener('DOMContentLoaded', () => {
            showStep(currentStep);
        });
    </script>
</x-guest-layout>
