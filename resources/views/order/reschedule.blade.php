@extends('layouts.product_layout')

@section('content')

<div class="container col-md-4 backblue my-5">
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
                    <input type="date" name="scheduleDate" class="form-control" id="scheduleDate" required min="{{ now()->addDays(7)->toDateString() }}">
                </div>
                <div class="form-group">
                    <label for="scheduleTime">Select a New Schedule Time</label>
                    <select name="scheduleTime" class="form-control" id="scheduleTime" required>
                        <!-- Time slots will be populated here by JavaScript based on date availability -->
                    </select>
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

    // Set the minimum date to 7 days from today
    const today = new Date();
    const minDate = new Date(today.setDate(today.getDate() + 2)).toISOString().split("T")[0];
    scheduleDateInput.min = minDate;

    // Fetch and update available slots for the selected date
    scheduleDateInput.addEventListener("change", function () {
        const scheduleDate = scheduleDateInput.value;

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
            scheduleTimeSelect.innerHTML = ''; // Clear existing options

            for (const [time, slots] of Object.entries(data)) {
                const option = document.createElement("option");
                option.value = time;
                option.textContent = `${time} (${slots} slots available)`;

                // Disable option if no slots are available
                if (slots === 0) {
                    option.disabled = true;
                }

                scheduleTimeSelect.appendChild(option);
            }
        })
        .catch(error => console.error('Error fetching availability:', error));
    });
});
</script>

@endsection
