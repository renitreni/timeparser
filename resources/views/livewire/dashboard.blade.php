<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-3">
                    <form wire:submit.prevent="save">
                        <input type="file" wire:model="timesheet" id="upload{{ $iteration }}">

                        @error('timesheet')
                            <span class="error">{{ $message }}</span>
                        @enderror

                        <button class="btn btn-info" type="submit">Upload Timesheet</button>
                    </form>
                </div>
                <div class="col-auto mb-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Clear All Data
                    </button>
                </div>
                <div class="col-auto mb-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" wire:click="exportToExcel">
                        Export To Excel
                    </button>
                </div>
                <div class="col-12 mb-3">
                    <livewire:attendance />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to Clear All Data?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" wire:click="destroyAll()">Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
