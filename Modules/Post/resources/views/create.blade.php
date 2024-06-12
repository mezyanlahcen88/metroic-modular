<x-default-layout>
    @section('breadcrumb')
        @include('components.breadcrumb-list', [
            'title' => trans('translation.post_action_add'),
            'listPermission' => 'post-list',
            'listRoute' => route('post.index'),
            'listText' => trans('translation.post_form_posts_list'),
        ])
    @endsection
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h3 class="card-title">Title</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <x-input-field cols="col-md-6" divId="name" column="name" model="user"
                                optional="text-danger" inputType="text" className="" columnId="name"
                                columnValue="{{ old('name') }}" attribute="required" readonly="false" />
                            <x-input-field cols="col-md-6" divId="author" column="author" model="user"
                                optional="text-danger" inputType="text" className="" columnId="author"
                                columnValue="{{ old('author') }}" attribute="required" readonly="false" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    @push('scripts')
    @endpush
</x-default-layout>
