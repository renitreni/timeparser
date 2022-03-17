<x-livewire-tables::bs5.table.cell>
    {{ $row->id }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <div class="row">
       <div class="col-3">
           <label class="badge rounded-pill bg-primary w-100">{{ $row->roles->toArray()[0]['name'] ?? 'Not Set' }}</label>
       </div>
        <div class="col-auto">
            <a href="{{ route('user.edit', ['user' => $row->id]) }}">{{ $row->name }}</a>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->created_at }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <button wire:click="destroy({{ $row->id }})" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
</x-livewire-tables::bs5.table.cell>

