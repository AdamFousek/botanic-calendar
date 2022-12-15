@php
$class = (int)$layer === 0 ? 'bg-white' : 'bg-gray-'.$layer.'00';
@endphp

<tr class="{{ $class }} border-b">
    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900" @if($action['parent_id'] === null) colspan="2" @endif>
        {{ $action['name'] }}
    </td>
    @if($action['parent_id'] !== null)
    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900" @if($action['parent_id'] === null) colspan="2" @endif>
        {{ $action['parent_name'] }}
    </td>
    @endif
    <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
        <ul>
            @foreach($action['fields'] as $field)
                <li>{{ $field['name'] }} <span class="text-sm">({{ $field['type'] }})</span>
                    @if($field['type'] === 'select')
                        <ul class="px-2">
                            @foreach($field['options'] as $option)
                                <li>{{$option['option']}}</li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
        @foreach($action['notifications'] as $notification)
            @if(!$loop->last)
                {{ $notification['days'] }},
            @else
                {{ $notification['days'] }}
            @endif
        @endforeach
    </td>
    <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap text-right">
        <x-icon-link :href="route('experiment.actions.createSubAction', [$experiment->project, $experiment, $action['id']])" name="plus" variant="mini" class="hover:bg-emerald-500" title="{{ __('Add sub action') }}" />
        <x-icon-link :href="route('experiment.actions.edit', [$experiment->project, $experiment, $action['id']])" name="pencil" variant="mini" class="hover:bg-yellow-500" title="{{ __('Edit action') }}" />
        <x-icon-link data-bs-toggle="modal" data-bs-target="#deleteAction_{{ $action['id'] }}" name="trash" variant="mini" class="ml-2 cursor-pointer hover:bg-red-500" title="{{ __('Remove action') }}" />
    </td>
</tr>

<!-- Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="deleteAction_{{ $action['id'] }}" tabindex="-1" aria-labelledby="deleteAction_{{ $action['id'] }}" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none">
        <livewire:actions.forms.delete :actionId="$action['id']" />
    </div>
</div>

@foreach($action['subActions'] as $subAction)
    @include('livewire/experiment/components/part/action', ['action' => $subAction, 'layer' => $layer + 1])
@endforeach