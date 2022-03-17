
<x-livewire-tables::bs5.table.cell>
{{ $row->person_id}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
{{ $row->date_in}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
{{ $row->time_in}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
{{ $row->time_out }}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
{{ \Carbon\Carbon::parse($row->time_in)->diffInHours($row->time_out) - 1 }} <br>
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell>
@if(!$row->time_out) 
 <span class="badge bg-warning text-dark">No Time-Out</span>
@elseif(!$row->time_in) 
 <span class="badge bg-info text-dark">No Time-In</span> 
@else 
 <span class="badge bg-success">OK</span> 
@endif
</x-livewire-tables::bs5.table.cell>
