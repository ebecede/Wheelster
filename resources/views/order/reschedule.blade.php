@extends('layouts.product_layout')

@section('content')

<div class="container col-md-4 col-sm-8 col-10 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Reschedule Form</h1>
    </div>
    <hr style="border-color: black;"> <br>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('reschedule_order', $order) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="scheduleDate">Select a New Schedule Date</label>
                    <input type="date" name="scheduleDate" class="form-control @error('scheduleDate') is-invalid @enderror"
                           id="scheduleDate" min="{{ now()->addDays(7)->toDateString() }}">
                    @error('scheduleDate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="scheduleTime">Select a New Schedule Time</label>
                    <select name="scheduleTime" class="form-control @error('scheduleTime') is-invalid @enderror" id="scheduleTime">
                        <option value="" selected disabled>Select a Schedule</option>
                        <!-- Time slots will be dynamically populated here -->
                    </select>
                    @error('scheduleTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const scheduleDateInput = document.getElementById("scheduleDate");
    const scheduleTimeSelect = document.getElementById("scheduleTime");

    // Set minimum date dynamically
    const today = new Date();
    const minDate = new Date(today.setDate(today.getDate() + 2)).toISOString().split("T")[0];
    scheduleDateInput.min = minDate;

    // Reset the schedule time select
    function resetScheduleTimeSelect() {
        scheduleTimeSelect.innerHTML = ''; // Clear existing options
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Select a Schedule";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        scheduleTimeSelect.appendChild(defaultOption);
    }

    // Fetch available time slots based on the selected date
    scheduleDateInput.addEventListener("change", function () {
        const scheduleDate = scheduleDateInput.value;

        if (!scheduleDate) {
            resetScheduleTimeSelect();
            return;
        }

        fetch('{{ route('check_availability') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ scheduleDate: scheduleDate })
        })
        .then(response => response.json())
        .then(data => {
            resetScheduleTimeSelect(); // Reset dropdown with the default option

            if (Object.keys(data).length === 0) {
                const noSlotsOption = document.createElement("option");
                noSlotsOption.textContent = "No available slots for this date.";
                noSlotsOption.disabled = true;
                scheduleTimeSelect.appendChild(noSlotsOption);
                return;
            }

            for (const [time, slots] of Object.entries(data)) {
                const option = document.createElement("option");
                option.value = time;
                option.textContent = `${time} (${slots} slots available)`;

                if (slots === 0) {
                    option.disabled = true;
                }

                scheduleTimeSelect.appendChild(option);
            }
        })
        .catch(error => console.error('Error fetching availability:', error));
    });

    // Initialize with default state
    resetScheduleTimeSelect();
});
</script>

@endsection
