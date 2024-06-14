<div class="col-md-12">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Grafik Simpanan
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <!-- Filter Form -->
            <form method="get" class="form-inline">
                <div class="input-group">
                    <label class="mr-2" for="tahun_simpanan">Pilih Tahun</label>
                    <select name="tahun_simpanan" id="tahun_simpanan" class="form-control" onchange="this.form.submit()">
                        <option value="">All</option>
                        <?php foreach ($tahunSimpanan as $year) : ?>
                            <option value="<?= $year['tahun_simpanan']; ?>" <?= ($selectedYearSimpanan == $year['tahun_simpanan']) ? 'selected' : ''; ?>>
                                <?= $year['tahun_simpanan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
            <div class="chart">
                <canvas id="JenisSimpananChart" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Grafik Pinjaman
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <!-- Filter Form -->
            <form method="get" class="form-inline">
                <div class="input-group">
                    <label class="mr-2" for="tahun_simpanan">Pilih Tahun</label>
                    <select name="tahun_pinjaman" id="tahun_pinjaman" class="form-control" onchange="this.form.submit()">
                        <option value="">All</option>
                        <?php foreach ($tahunPinjaman as $year) : ?>
                            <option value="<?= $year['tahun']; ?>" <?= ($selectedYearPinjaman == $year['tahun']) ? 'selected' : ''; ?>>
                                <?= $year['tahun']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>

            <div class="chart">
                <canvas id="pinjamanDataChart" style="width: 100%; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>


<!-- <div class="col-md-12">
    <div class="card card-default color-palette-box">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    Grafik Pemasukkan & Pengeluaran
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body col-md-12">
            <canvas id="keunganChart" style="height:400px"></canvas>
        </div>
    </div>
</div> -->

<!-- Load Chart.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>

<!-- data keuangan -->
<script>
    // Data from your controller
    var pemasukkan = <?php echo $pemasukkan; ?>;
    var pengeluaran = <?php echo $pengeluaran; ?>;

    // Create a combined bar chart
    var ctx = document.getElementById('keunganChart').getContext('2d');
    var keunganChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pemasukkan', 'Pengeluaran'],
            datasets: [{
                label: 'Total Keuangan',
                data: [pemasukkan, pengeluaran],
                backgroundColor: getRandomColorArray(2), // Call the function to generate random colors
                borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Function to generate random colors
    function getRandomColorArray(numColors) {
        var colors = [];
        for (var i = 0; i < numColors; i++) {
            colors.push('rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.7)');
        }
        return colors;
    }
</script>

<!-- data simpanan (jenis simpanan) -->
<script>
    // Function to generate random rgba color
    function randomColor() {
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return 'rgba(' + r + ',' + g + ',' + b + ', 0.2)';
    }

    // JavaScript to create the Chart
    var ctx = document.getElementById('JenisSimpananChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_map(function ($item) {
                        return $item['nama_jenis_simpanan'] . ' (' . $item['tahun_simpanan'] . ')';
                    }, $simpananDataFiltered)); ?>,
            datasets: [{
                label: 'Total Simpanan',
                data: <?= json_encode(array_column($simpananDataFiltered, 'total_simpanan')); ?>,
                backgroundColor: randomColor(), // Set initial random color
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

<!-- data pinjaman filtered -->
<script>
    // Get the data from PHP and convert it to a JavaScript array
    var chartData = <?php echo json_encode($pinjamanDataFiltered); ?>;

    // Extract years and total amounts for chart data
    var years = chartData.map(function(item) {
        return item.tahun;
    });

    var totalAmounts = chartData.map(function(item) {
        return item.total_jumlah_pinjaman;
    });

    // Generate random colors
    var randomColors = Array.from({
        length: years.length
    }, function() {
        var r = Math.floor(Math.random() * 256);
        var g = Math.floor(Math.random() * 256);
        var b = Math.floor(Math.random() * 256);
        return `rgba(${r}, ${g}, ${b}, 0.2)`;
    });

    // Create a bar chart with random colors
    var ctx = document.getElementById('pinjamanDataChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Total Pinjaman',
                data: totalAmounts,
                backgroundColor: randomColors,
                borderColor: randomColors.map(color => color.replace('0.2', '1')),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>