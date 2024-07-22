@component($typeForm, get_defined_vars())
    <div data-controller="relation" data-relation-id="{{ $id }}"
        data-relation-placeholder="{{ $attributes['placeholder'] ?? '' }}" data-relation-model="{{ $relationModel }}"
        data-relation-name="{{ $relationName }}" data-relation-key="{{ $relationKey }}"
        data-relation-scope="{{ $relationScope }}" data-relation-search-columns="{{ $relationSearchColumns }}"
        data-relation-append="{{ $relationAppend }}" data-relation-chunk="{{ $chunk }}"
        data-relation-allow-empty="{{ $allowEmpty }}" data-relation-route="{{ route('platform.systems.relation') }}"
        data-relation-message-notfound="{{ __('No results found') }}" data-relation-message-add="{{ __('Add') }}"
        data-relation-allow-add="{{ var_export($allowAdd, true) }}">
        <div class="input-group mb-3">
            <select id="{{ $id }}" data-relation-target="select" {{ $attributes }}>
                @foreach ($value as $option)
                    <option selected value="{{ $option['id'] }}">{{ $option['text'] }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <button type="button" class="btn btn-default" data-controller="modal-toggle"
                    
                    data-action="click->modal-toggle#targetModal" {{-- data-modal-toggle-title="{{ $modalTitle ?? ($title ?? '') }}" --}}
                    data-modal-toggle-key="{{ $modalTarget ?? '' }}" data-modal-toggle-async="{{ $modalAsync }}"
                    data-modal-toggle-params='@json($parameters)'
                     data-modal-toggle-action="{{ $action }}" 
                     data-modal-toggle-open="{{ $modalOpen }}"
                    open="false">
                    @isset($toggleIcon)
                        <x-orchid-icon :path="$toggleIcon" class="me-2" />
                    @endisset
                    @isset($toggleLabel)
                        <span>{{$toggleLabel}}</span>
                    @endisset

                </button>
            </div>
        </div>
    </div>
@endcomponent
