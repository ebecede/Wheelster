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

            <form action="{{ route('make_order', $product) }} " method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="vehicleName">Vehicle Name and Model</label>
                    <input type="text" name="vehicleName" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="steeringWheelPhoto">Car Steering Wheel Photo</label>
                    <input type="file" name="steeringWheelPhoto" class="form-control" accept=".jpg,.jpeg,.png,.webp,.heic" required>
                    <p class="info-text text-muted ms-1">Photo must be in .jpg, .jpeg, .png, .webp, or .heic format and Max 5 MB.</p>
                </div>
                <div class="form-group">
                    <label for="schedule">Select a Schedule Date</label>
                    <input type="date" name="scheduleDate" class="form-control" id="scheduleDate" required>
                </div>
                <div class="form-group">
                    <label for="scheduleTime">Select a Schedule Time</label>
                    <select name="scheduleTime" class="form-control" required>
                    </select>
                </div>
                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelector("input[name='steeringWheelPhoto']").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/heic'];
        if (!allowedTypes.includes(file.type)) {
            alert("The photo must be a file of type: jpg, jpeg, png, webp, heic.");
            event.target.value = ""; // Reset the input
            return;
        }

        const maxSize = 5 * 1024 * 1024; // 5 MB in bytes
        if (file.size > maxSize) {
            alert("The photo size must not exceed 5 MB.");
            event.target.value = ""; // Reset the input
        }
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const scheduleDateInput = document.getElementById("scheduleDate");
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 2);
    const year = tomorrow.getFullYear();
    const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
    const day = String(tomorrow.getDate()).padStart(2, '0');
    scheduleDateInput.min = `${year}-${month}-${day}`;

    const scheduleTimeSelect = document.querySelector("select[name='scheduleTime']");

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
