<div class="d-flex text-start">
    <!--begin:: Avatar -->
    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
        <a href="{{ route('admin.users.show', $object->uuid) }}">
            <div class="symbol-label">
                <img src="{{ URL::asset(getPicture($object->picture, 'users')) }}" alt="{{ $object->getFullName() }}"
                    class="w-100" />
            </div>
        </a>
    </div>
    <!--end::Avatar-->
    <!--begin::User details-->
    <div class="d-flex flex-column">
        <a href="{{ route('admin.users.show', $object->uuid) }}"
            class="text-gray-800 text-hover-primary mb-1">{{ $object->getFullName() }}</a>
        <span>{{ $object->email }}</span>
    </div>
    <!--begin::User details-->
</div>
