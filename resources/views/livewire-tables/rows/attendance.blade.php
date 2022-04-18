<x-livewire-tables::bs5.table.cell>
    {{ $row->person_id}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    @if($currentRowId == $row->id)
        <input class="form-control" type="text" wire:model.debounce.1000ms="currentPerson">
    @else
        {{ $row->person}}
    @endif
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->base_date}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    @if($currentRowId == $row->id)
        <input class="form-control" type="time" wire:model.debounce.1000ms="currentTimeIn">
    @else
        {{ $row->time_in ? \Carbon\Carbon::parse($row->time_in)->format('h:i A') : ''}}
    @endif
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    @if($currentRowId == $row->id)
        <input class="form-control" type="time" wire:model.debounce.1000ms="currentTimeOut">
    @else
        {{ $row->time_out ? \Carbon\Carbon::parse($row->time_out)->format('h:i A') : ''}}
    @endif
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell style="width:180px">
    @if($currentRowId == $row->id)
        <button class="btn btn-success btn-sm" type="button" wire:click="setToSave({{ $row->id }})">Save</button>
        <button class="btn btn-danger btn-sm" type="button" wire:click="setToDelete({{ $row->id }})">Delete</button>
    @else
        <button class="btn btn-primary btn-sm" type="button" wire:click="setToEdit({{ $row->id }})">Edit</button>
    @endif
</x-livewire-tables::bs5.table.cell>
