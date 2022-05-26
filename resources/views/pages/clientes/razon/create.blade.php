<x-modal.modal-sm>
    <x-slot name="modalhead"> {{ $action }} Razón Social </x-slot>
    <div>
        <form action="#" method="post">
            <div class="pt-2">
                <x-form.label for="razon">Razon Social</x-form.label>
                <x-input type="text" name="razon" wire:model="nombre" id="razon" placeholder="Razón Social"
                    class="w-full" required />
                @error('razon') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="pt-3">
                <x-form.label for="direccion">Dirección</x-form.label>
                <x-input type="text" wire:model="direccion" name="direccion" id="direccion"
                    placeholder="Dirección Fiscal" class="w-full" />
                @error('direccion') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div class="pt-2">
                    <x-form.label for="estado">Estado</x-form.label>
                    <x-input type="text" wire:model="estado" name="estado" id="estado" placeholder="NL"
                        class="w-full" />
                    @error('estado') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2">
                    <x-form.label for="municipio">Municipio</x-form.label>
                    <x-input type="text" wire:model="municipio" name="municipio" id="municipio"
                        placeholder="San Nicolas" class="w-full" />
                    @error('municipio') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2">
                    <x-form.label for="cp">Código Postal</x-form.label>
                    <x-input type="text" wire:model="cp" name="cp" id="cp" placeholder="Código Postal" class="w-full" />
                    @error('cp') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>
                <div class="pt-2">
                    <x-form.label for="telefono">Teléfono</x-form.label>
                    <x-input type="text" wire:model="telefono" name="telefono" id="telefono" placeholder="Telefono"
                        class="w-full" />
                    @error('telefono') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                </div>

            </div>
            <div class="pt-2">
                <x-form.label for="regimen">Régimen Fiscal</x-form.label>

                <input list="regimen" wire:model="regimen"
                    class="rounded-lg shadow-sm border px-3 py-2 border-indigo-400 focus:border-indigo-500 focus:ring-indigo-400 focus:ring-opacity-50 sm:text-sm w-full"
                    placeholder="Régimen Fiscal">

                <datalist id="regimen">
                    <option value="Régimen de asalariados">
                    <option value="Régimen de servicios profesionales (honorarios)">
                    <option value="Régimen de arrendamiento de inmuebles">
                    <option value="Régimen de actividad empresarial">
                    <option value="Régimen de incorporación fiscal">
                    <option value="Régimen general">
                    <option value="Régimen de personas morales con fines no lucrativos">
                </datalist>

                @error('regimen') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end">
                <x-form.btn-primary class="py-2 rounded px-4">Guardar</x-form.btn-primary>
            </div>
        </form>
    </div>
</x-modal.modal-sm>
