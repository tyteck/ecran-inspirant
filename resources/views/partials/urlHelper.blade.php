<form>
    <div>
        <label for="preset" class="block text-sm font-medium leading-6">Sélectionne l'écran
            désiré</label>
        <select id="preset" name="preset" x-model="preset"
            class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-inset bg-{{ $color }}-800 ring-{{ $color }}-300 focus:ring-2 focus:ring-{{ $color }}-600 sm:text-sm sm:leading-6">
            <option value="">Pour quel écran</option>
            @foreach ($presets as $preset)
                <option value="{{ $preset->value }}"">
                    {{ $preset->label() }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4 rounded-lg bg-{{ $color }}-800 py-1.5 pl-3 pr-10">
        Le lien ci dessous t'emmènera sur un ecran inspirant pour ton appareil.
        <div class="text-centered mx-auto w-full">
            <a x-bind:href="getUrl + preset" target="_blank" class="text-lg md:text-xl hover:underline"><span
                    x-text="getUrl+preset"></span></a>
        </div>
    </div>
</form>
