<div class="{{ $cols }} my-1" id="{{ $divID ?? '' }}">
    <div class="form-group">

        <label for="{{ $column }}" class="form-label"> {{ trans('translation.' . $label) }} &nbsp;
            <span class="{{ $optional }}">*</span></label>
        <select class="form-select" data-control="select2"
            data-placeholder="{{ trans('translation.general_general_select') }}" name="{{ $column }}"
            id="{{ $id ?? '' }}">
            @foreach ($options as $key => $value)
                @if ($object)
                    <option value="{{ $key }}" {{ $key == $object->$column ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @else
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    @error($column)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <div>
        <span class="text-danger error" id="error_{{ $column }}"></span>
    </div>
    <span id="{{ $column }}-error" class="help-block error-help-block error"></span>
</div>
