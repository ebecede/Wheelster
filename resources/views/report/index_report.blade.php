@extends('layouts.product_layout')

@section('pageStyle')
    <style>
        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        #yearDropdown {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            border: none;
            padding: .375rem .75rem;
            background-color: #001F54;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
            border-radius: 12px;
            cursor: pointer;
        }

        .btn-style {
            padding: .375rem .75rem;
            background-color: #001F54;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
            border: none;
            border-radius: 12px;
            cursor: pointer;
        }

        .btn-style:hover,
        #yearDropdown:hover {
            background-color: #002F77;
        }

        .chart-container {
            margin-top: 20px;
        }

        .chart-item {
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .chart-title.hidden {
            display: none;
        }

        canvas {
            width: 100%;
            height: 300px;
        }

        h2.chart-title {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s ease;
        }

        .overlay.show {
            visibility: visible;
            opacity: 1;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
        }
        .overlay canvas {
            width: 90vw;
            height: 80vh;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <h1>Report</h1><br>
        <div class="control-group">
            <select id="yearDropdown" class="btn-style dropdown-toggle pe-3">
                @foreach ($years as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
            <button id="viewReport" class="btn-style pe-3">View Report</button>
            <button id="exportChart" class="btn-style pe-3">Export Chart</button>
        </div>

        <div class="chart-container">
            <!-- Brand Orders Chart -->
            <div class="chart-item" id="brandChartContainer">
                <canvas id="brandChart"></canvas>
                <h2 id="brandChartTitle" class="chart-title hidden">Brand Orders by Month</h2>
            </div>

            <!-- Profit Gained Chart -->
            <div class="chart-item" id="profitChartContainer">
                <canvas id="profitChart"></canvas>
                <h2 id="profitChartTitle" class="chart-title hidden">Profit Gained by Month</h2>
            </div>
        </div>
    </div>

    <!-- Fullscreen Overlay (NOT YET FIN) -->
    <div class="overlay" id="overlayChart">
        <button class="close-btn" id="closeBtn">&times;</button>
        <canvas id="fullscreenChartCanvas"></canvas>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let brandChartInstance;
        let profitChartInstance;

        document.getElementById('viewReport').addEventListener('click', function() {
            const selectedYear = document.getElementById('yearDropdown').value;

            const url = `{{ route('getMonthlyData', ':year') }}`.replace(':year', selectedYear);

            fetchChartData(url);
        });

        function fetchChartData(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const labels = data.labels;
                    const brandDataset = data.dataset;
                    const profitData = data.monthlyProfit;

                    if (brandChartInstance) brandChartInstance.destroy();
                    if (profitChartInstance) profitChartInstance.destroy();
                    if (labels.length > 0 && brandDataset.length > 0) {
                        document.getElementById('brandChartTitle').classList.remove('hidden');
                    } else {
                        document.getElementById('brandChartTitle').classList.add('hidden');
                    }

                    if (labels.length > 0 && profitData.length > 0) {
                        document.getElementById('profitChartTitle').classList.remove('hidden');
                    } else {
                        document.getElementById('profitChartTitle').classList.add('hidden');
                    }

                    const brandCtx = document.getElementById('brandChart').getContext('2d');
                    brandChartInstance = new Chart(brandCtx, {
                        type: 'line',
                        data: { labels: labels, datasets: brandDataset },
                        options: { responsive: true }
                    });

                    const profitCtx = document.getElementById('profitChart').getContext('2d');
                    profitChartInstance = new Chart(profitCtx, {
                        type: 'bar',
                        data: { labels: labels, datasets: [{ label: 'Profit', data: profitData }] },
                        options: { responsive: true }
                    });
                })
                .catch(error => console.error('Error fetching chart data:', error));
        }

        // Export Both Charts
        document.getElementById('exportChart').addEventListener('click', function() {

            const brandLink = document.createElement('a');
            brandLink.href = brandChartInstance.toBase64Image();
            brandLink.download = 'brand_chart.png';
            brandLink.click();


            const profitLink = document.createElement('a');
            profitLink.href = profitChartInstance.toBase64Image();
            profitLink.download = 'profit_chart.png';
            profitLink.click();
        });


        const overlay = document.getElementById('overlay');
        const fullscreenCtx = document.getElementById('fullscreenChartCanvas').getContext('2d');
        let fullscreenChartInstance;


        document.getElementById('brandChart').addEventListener('click', function() {
            console.log("brandChart clicked");
            if (brandChartInstance) {
                console.log(brandChartInstance.data);
                if (fullscreenChartInstance) fullscreenChartInstance.destroy();

                let typeOptions = brandChartInstance.config._config.type;
                let dataOptions = brandChartInstance.data;
                let optionsOptions = {responsive:true};
                fullscreenChartInstance = new Chart(fullscreenCtx, {
                    type: typeOptions,
                    data: dataOptions,
                    options: optionsOptions
                });

                overlay.classList.add('show');
                console.log("Overlay shown");
            } else {
                console.error("brandChartInstance is not defined.");
            }
        });

        // Close Fullscreen Overlay
        document.getElementById('closeBtn').addEventListener('click', function() {
            overlay.classList.remove('show');
            if (fullscreenChartInstance) fullscreenChartInstance.destroy();
            console.log("Overlay closed via close button");
        });

        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('show');
                if (fullscreenChartInstance) fullscreenChartInstance.destroy();
                console.log("Overlay closed by clicking outside");
            }
        });
    </script>
@endsection
