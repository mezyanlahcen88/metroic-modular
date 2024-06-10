<x-default-layout>
    @section('breadcrumb')
        @include('components.breadcrumb', [
            'title' => trans('translation.client_form_manage_clients'),
            'createPermission' => 'client-create',
            'createRoute' => route('client.create'),
            'createText' => trans('translation.client_action_add'),
            'deletedPermission' => 'client-trashed',
            'deletedRoute' => route('client.trashed'),
            'deletedText' => trans('translation.client_form_deleted_clients_list'),
        ])
    @endsection
    <div class="card">
        <div class="card-header border-0">
            @include('components.datatable-header')
        </div>
        <div class="card-body mt-n5">
            @include('client::trashedTable', [
                'model' => 'client',
            ])
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/custom_js/delete.js') }}"></script>
        <script src="{{ asset('assets/custom_js/datatable.js') }}"></script>
    @endpush
</x-default-layout>
