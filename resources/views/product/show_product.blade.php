@extends('layouts.product_layout')

@section('content')
<div class="container col-sm-8 col-10 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Order Form</h1>
    </div>
    <hr style="border-color: black;"> <br>
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <img src="{{ url('storage/public/' . $product->image) }}" alt="" class="img-fluid">
        </div>
        <div class="col-lg-6 col-md-12">
            <h4><strong>{{ $product->name }}</strong></h4>
            <h3><strong>Rp{{ number_format($product->price, 2) }}</strong></h3>
            <p>Product Description: <br> {{ $product->description }}</p>

            <!-- Form -->
            <form action="{{ route('make_order', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="vehicleName">Vehicle Name and Model</label>
                    <input type="text" name="vehicleName" class="form-control @error('vehicleName') is-invalid @enderror" value="{{ old('vehicleName') }}">
                    @error('vehicleName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="steeringWheelPhoto">Car Steering Wheel Photo</label>
                    <input type="file" name="steeringWheelPhoto" class="form-control @error('steeringWheelPhoto') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp,.heic">
                    <p class="info-text text-muted ms-1">Photo must be in .jpg, .jpeg, .png, .webp, or .heic format and Max 5 MB.</p>
                    @error('steeringWheelPhoto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="scheduleDate">Select a Schedule Date</label>
                    <input type="date" name="scheduleDate" class="form-control @error('scheduleDate') is-invalid @enderror" id="scheduleDate" value="{{ old('scheduleDate') }}">
                    @error('scheduleDate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="scheduleTime">Select a Schedule Time</label>
                    <select name="scheduleTime" class="form-control @error('scheduleTime') is-invalid @enderror">
                        <option value="" selected disabled>Select a Schedule</option>
                        <!-- Slot options will be dynamically populated -->
                    </select>
                    @error('scheduleTime')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const scheduleDateInput = document.getElementById("scheduleDate");
    const scheduleTimeSelect = document.querySelector("select[name='scheduleTime']");

    // Set minimum date to 2 days from today
    const today = new Date();
    const minDate = new Date(today.setDate(today.getDate() + 2)).toISOString().split("T")[0];
    scheduleDateInput.min = minDate;

    // Reset the schedule time select dropdown
    function resetScheduleTimeSelect() {
        scheduleTimeSelect.innerHTML = ''; // Clear existing options
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Select a Schedule";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        scheduleTimeSelect.appendChild(defaultOption);
    }

    // Fetch and update available slots for the selected date
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

                // Disable option if no slots are available
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
