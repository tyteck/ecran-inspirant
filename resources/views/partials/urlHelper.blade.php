<form>
    <div>
        <label for="preset" class="block text-sm font-medium leading-6">Sélectionne l'écran
            désiré</label>
        <select id="preset" name="preset" x-on:change="setPreset(event)"
            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-inset bg-{{ $color }}-800 ring-{{ $color }}-300 focus:ring-2 focus:ring-{{ $color }}-600 sm:text-sm sm:leading-6">
            <option value="">Pour quel écran</option>
            @foreach ($presets as $preset)
                <option value="{{ $preset->value }}">
                    {{ $preset->label() }}</option>
            @endforeach
        </select>

        <div class="mt-2">
            <label class="block text-sm font-medium leading-6">Ou bien directement la résolution de ton
                écran</label>
            <div class="flex items-center max-w-screen-xl mx-auto">
                <div class="relative mt-2 sm:mr-2 rounded-md shadow-sm">
                    <label for="width" class="block text-sm font-medium leading-6">Largeur</label>
                    <input type="text" name="width" id="width" x-on:change.debounce="setWidth($event)"
                        class="block w-full rounded-md border-0 pl-2 py-1.5 pr-10 bg-{{ $color }}-800 ring-{{ $color }}-300 ring-1 ring-inset placeholder:text-{{ $color }}-100 focus:ring-2 focus:ring-inset focus:ring-{{ $color }}-600 sm:text-sm sm:leading-6"
                        placeholder="1920" aria-invalid="true" x-model="imageWidth" aria-describedby="image width">
                    <small>la largeur doit être supérieure à 300</small>
                </div>
                <div class="relative mt-2 rounded-md shadow-sm">
                    <label for="height" class="block text-sm font-medium leading-6">Hauteur</label>
                    <input type="text" name="width" id="height" x-on:change.debounce="setHeight($event)"
                        class="block w-full rounded-md border-0 pl-2 py-1.5 pr-10 bg-{{ $color }}-800 ring-{{ $color }}-300 ring-1 ring-inset placeholder:text-{{ $color }}-100 focus:ring-2 focus:ring-inset focus:ring-{{ $color }}-600 sm:text-sm sm:leading-6"
                        placeholder="1920" aria-invalid="true" x-model="imageHeight" aria-describedby="image height">
                    <small>la hauteur doit être supérieure à 300</small>

                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 rounded-lg bg-{{ $color }}-800 py-1.5 pl-3 pr-10">
        Le lien ci dessous t'emmènera sur un ecran inspirant pour ton appareil.
        <div class="text-centered mx-auto w-full">
            <a x-bind:href="displayUrl" target="_blank" class="text-lg md:text-xl hover:underline">
                <span x-text="displayUrl"></span>
            </a>
        </div>
    </div>
</form>
