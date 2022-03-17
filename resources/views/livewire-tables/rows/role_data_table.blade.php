<x-livewire-tables::bs5.table.cell>
    {{ $row->id }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    <a href="{{ route('permission.edit',['role'=> $row->id]) }}" class="btn btn-sm btn-primary">Permissions</a>
    <a href="{{ route('role.edit',['role'=> $row->id]) }}">{{ $row->name }}</a>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->created_at }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
    {{ $row->updated_at }}
</x-livewire-tables::bs5.table.cell>
