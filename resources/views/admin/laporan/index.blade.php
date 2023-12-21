@extends('layouts.app', ['title' => 'LAPORAN - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto">
        <div class="flex items-center">

            <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">Analytics</h1>
                    </div>
                </div>

                <div class="container mt-5 mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Select Menus -->
                        <div class="w-full p-2">
                            <select class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <select class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>
                        </div>
                        <div class="w-full p-2">
                            <select class="w-full p-2 border border-gray-400 rounded-md">
                                <option value="option1">Option 1</option>
                                <option value="option2">Option 2</option>
                                <option value="option3">Option 3</option>
                            </select>
                        </div>
                        <!-- End Select Menus -->

                        <!-- Chart container with horizontal scroll -->
                        <div class="w-full col-span-2 p-2 overflow-x-auto">
                            <canvas id="candidateChart" class="chartjs" style="width: 100%; height: 500px;"></canvas>
                        </div>
                    </div>

                    <!-- Include Chart.js library -->
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <!-- Script to generate the chart -->
                    <script>
                        // Sample data for candidates
                        const candidateData = {
                            labels: ["Candidate 1", "Candidate 2", "Candidate 3", "Candidate 4", "5", "6", "7", "8"],
                            datasets: [{
                                label: "Votes",
                                data: [30, 50, 20, 40, 30, 50, 20, 40],
                                backgroundColor: ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)"],
                                borderColor: ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)"],
                                borderWidth: 1
                            }]
                        };

                        // Get the chart canvas element
                        const candidateChartCanvas = document.getElementById('candidateChart');

                        // Create the chart
                        const candidateChart = new Chart(candidateChartCanvas, {
                            type: 'bar',
                            data: candidateData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false, // Disable aspect ratio maintenance
                                scales: {
                                    x: {
                                        beginAtZero: true
                                    },
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
