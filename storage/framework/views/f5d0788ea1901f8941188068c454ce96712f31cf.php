

<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Order Harian
                </div>
                <div class="card-body">
                    <canvas id="dailyOrdersChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Total Penjualan Bulanan
                </div>
                <div class="card-body">
                    <canvas id="totalSalesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Penjualan Terbanyak
                </div>
                <div class="card-body">
                    <canvas id="topProductsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

<script>
    // Total Sales Chart
    var totalSalesData = <?php echo json_encode($totalSalesData, 15, 512) ?>;
    var totalSalesLabels = totalSalesData.map(item => item.month);
    var totalSalesValues = totalSalesData.map(item => item.total_sales);

    var totalSalesChartCanvas = document.getElementById('totalSalesChart').getContext('2d');
    var totalSalesChart = new Chart(totalSalesChartCanvas, {
        type: 'bar',
        data: {
            labels: totalSalesLabels,
            datasets: [{
                label: 'Total Sales',
                data: totalSalesValues,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Order Status Distribution Chart


    // Top Selling Products Chart
    var topProductsData = <?php echo json_encode($topProductsData, 15, 512) ?>;
    var topProductsLabels = topProductsData.map(item => item.nameProduct);
    var topProductsValues = topProductsData.map(item => item.total_quantity);

    var topProductsChartCanvas = document.getElementById('topProductsChart').getContext('2d');
    var topProductsChart = new Chart(topProductsChartCanvas, {
        type: 'bar',
        data: {
            labels: topProductsLabels,
            datasets: [{
                label: 'Total Quantity',
                data: topProductsValues,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var data = <?php echo json_encode($totalSalesDataDaily, 15, 512) ?>;

    var labels = data.map(item => item.date);
    var orders = data.map(item => item.total_orders);

    var ctx = document.getElementById('dailyOrdersChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Orders',
                data: orders,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\ekasir\resources\views/Dashboard/index.blade.php ENDPATH**/ ?>