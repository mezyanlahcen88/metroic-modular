<x-default-layout>
    @section('breadcrumb')
        @include('components.breadcrumb', [
            'title' => trans('translation.post_form_manage_posts'),
            'createPermission' => 'post-create',
            'createRoute' => route('post.create'),
            'createText' => trans('translation.post_action_add'),
            'deletedPermission' => 'post-trashed',
            'deletedRoute' => route('post.trashed'),
            'deletedText' => trans('translation.post_form_deleted_posts_list'),
        ])
    @endsection
    <div class="card">
        <div class="card-header border-0">
            @include('components.datatable-header')
        </div>
        <div class="card-body mt-n5">
            @include('post::table', [
                'model' => 'post',
            ])
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/custom_js/delete.js') }}"></script>
        <script src="{{ asset('assets/custom_js/datatable.js') }}"></script>
    @endpush
</x-default-layout>
