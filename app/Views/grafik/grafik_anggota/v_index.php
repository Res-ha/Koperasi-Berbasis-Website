<div class="col-md-6">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Data Status Anggota:
                </h3>
            </div>
        </div>
        <div class="card-body col-md-12">
            <!-- Grafik anggota berdasarkan jenis kelamin -->
            <canvas id="statusChart" style="width: 100%; height: 300px;"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Data Jenis Kelamin Anggota:
                </h3>
            </div>
        </div>
        <div class="card-body col-md-12">
            <!-- Grafik anggota berdasarkan jenis kelamin -->
            <canvas id="genderChart" style="width: 100%; height: 300px;"></canvas>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Data Fakultas Anggota:
                </h3>
            </div>
        </div>
        <div class="card-body col-md-12">
            <!-- Grafik anggota berdasarkan fakultas -->
            <canvas id="facultyChart" style="width: 100%; height: 300px;"></canvas>
        </div>
    </div>
</div>
<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>

<!-- Inisialisasi grafik anggota berdasarkan jenis kelamin -->
<script>
    // Function to generate random rgba color
    function getRandomColor(alpha) {
        return `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${alpha})`;
    }

    // chart status anggota
    var statusData = <?= json_encode($statusData) ?>;
    var statusChartCanvas = document.getElementById('statusChart').getContext('2d');
    let delayedStatus;
    const statusChartConfig = {
        type: 'doughnut',
        data: {
            labels: Object.keys(statusData),
            datasets: [{
                data: Object.values(statusData),
                backgroundColor: [
                    getRandomColor(0.7),
                    getRandomColor(0.7),
                ],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                onComplete: () => {
                    delayedStatus = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayedStatus) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            },
        },
    };
    var statusChart = new Chart(statusChartCanvas, statusChartConfig);

    // chart jenis kelamin anggota
    var genderData = <?= json_encode($genderData) ?>;
    var genderChartCanvas = document.getElementById('genderChart').getContext('2d');
    let delayedGender;
    const genderChartConfig = {
        type: 'doughnut',
        data: {
            labels: Object.keys(genderData),
            datasets: [{
                data: Object.values(genderData),
                backgroundColor: [
                    getRandomColor(0.7),
                    getRandomColor(0.7),
                ],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                onComplete: () => {
                    delayedGender = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayedGender) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            },
        },
    };
    var genderChart = new Chart(genderChartCanvas, genderChartConfig);

    // chart fakultas anggota
    var facultyData = <?= $facultyData ?>;
    var facultyLabels = facultyData.map(function(item) {
        return item.kode_fakultas;
    });
    var facultyChartCanvas = document.getElementById('facultyChart').getContext('2d');
    let delayed;
    const facultyChartConfig = {
        type: 'bar',
        data: {
            labels: facultyLabels,
            datasets: [{
                label: 'Jumlah Anggota',
                data: facultyData.map(function(item) {
                    return item.jumlah_anggota;
                }),
                backgroundColor: getRandomColor(0.7),
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                onComplete: () => {
                    delayed = true;
                },
                delay: (context) => {
                    let delay = 0;
                    if (context.type === 'data' && context.mode === 'default' && !delayed) {
                        delay = context.dataIndex * 300 + context.datasetIndex * 100;
                    }
                    return delay;
                },
            },
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                },
            },
        },
    };
    var facultyChart = new Chart(facultyChartCanvas, facultyChartConfig);
</script>