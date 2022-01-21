<x-material-layout :activePage="'challenge'" :menuParent="'calendario'">
    <x-slot name="title">Challenge</x-slot>
    <x-slot name="titlePage">Challenge</x-slot>
    <livewire:challenge />
    @push('js')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.iconify.design/2/2.1.1/iconify.min.js"></script>
    @endpush
</x-material-layout>
