

<?php $__env->startSection('content'); ?>


    <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
    <h1 class="m-0">Dashboard v3</h1>
    </div>
    <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard v3</li>
    </ol>
    </div>
    </div>
    </div>
    </div>
    
    
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-info">
            <div class="inner">
            <h3>150</h3>
            <p>New Orders</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-success">
            <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>
            <p>Bounce Rate</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-warning">
            <div class="inner">
            <h3>44</h3>
            <p>User Registrations</p>
            </div>
            <div class="icon">
            <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            <div class="col-lg-3 col-6">
            
            <div class="small-box bg-danger">
            <div class="inner">
            <h3>65</h3>
            <p>Unique Visitors</p>
            </div>
            <div class="icon">
            <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            </div>
            
            </div>
        <div class="container-fluid">
            
        <div class="row">
        <div class="col-lg-6">
        <div class="card">
        <div class="card-header border-0">
        <div class="d-flex justify-content-between">
        <h3 class="card-title">Online Store Visitors</h3>
        <a href="javascript:void(0);">View Report</a>
        </div>
        </div>
        <div class="card-body">
        <div class="d-flex">
        <p class="d-flex flex-column">
        <span class="text-bold text-lg">820</span>
        <span>Visitors Over Time</span>
        </p>
        <p class="ml-auto d-flex flex-column text-right">
        <span class="text-success">
        <i class="fas fa-arrow-up"></i> 12.5%
        </span>
        <span class="text-muted">Since last week</span>
        </p>
        </div>
        
        <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <canvas id="visitors-chart" height="250" style="display: block; height: 200px; width: 838px;" width="1047" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
        <span class="mr-2">
        <i class="fas fa-square text-primary"></i> This Week
        </span>
        <span>
        <i class="fas fa-square text-gray"></i> Last Week
        </span>
        </div>
        </div>
        </div>
        
        <div class="card">
        <div class="card-header border-0">
        <h3 class="card-title">Купленные товары</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                <a href="#" class="dropdown-item">Action</a>
                <a href="#" class="dropdown-item">Another action</a>
                <a href="#" class="dropdown-item">Something else here</a>
                <a class="dropdown-divider"></a>
                <a href="#" class="dropdown-item">Separated link</a>
                </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
        <thead>
        <tr>
        <th>Продукт</th>
        <th>Цена</th>
        <th>Продажи</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
            
            <?php $__currentLoopData = $bestSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <img src="/Content/product/thumbnails/<?php echo e($product->thumbnail); ?>" alt="<?php echo e($product->name); ?>" class="img-circle img-size-32 mr-2">
                    <span class="name" title="<?php echo e($product->name); ?>"><?php echo e(\Illuminate\Support\Str::limit($product->name, 30)); ?></span>
                </td>
                <td><?php echo e($product->price, 0); ?> USD</td>
                <td>
                    <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                    </small>
                    <br>
                    <?php echo e($product->total_sales); ?> Sales
                </td>
                <td>
                    <a href="<?php echo e(route('admin.products.show', $product->id)); ?>" class="text-muted">
                        <i class="fas fa-search"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        </table>
        </div>
        <div class="card-footer text-center">
            <a href="javascript:void(0)" class="uppercase">Продукты для продажи</a>
            </div>
        </div>
       
        
        
        </div>
        
        <div class="col-lg-6">
        <div class="card">
        <div class="card-header border-0">
        <div class="d-flex justify-content-between">
        <h3 class="card-title">Sales</h3>
        <a href="javascript:void(0);">View Report</a>
        </div>
        </div>
        <div class="card-body">
        <div class="d-flex">
        <p class="d-flex flex-column">
        <span class="text-bold text-lg">$18,230.00</span>
        <span>Sales Over Time</span>
        </p>
        <p class="ml-auto d-flex flex-column text-right">
        <span class="text-success">
        <i class="fas fa-arrow-up"></i> 33.1%
        </span>
        <span class="text-muted">Since last month</span>
        </p>
        </div>
        
        <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <canvas id="sales-chart" height="250" style="display: block; height: 200px; width: 838px;" width="1047" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="d-flex flex-row justify-content-end">
        <span class="mr-2">
        <i class="fas fa-square text-primary"></i> This year
        </span>
        <span>
        <i class="fas fa-square text-gray"></i> Last year
        </span>
        </div>
        </div>
        </div>
        
        <div class="card">
            <div class="card-header border-0">
            <h3 class="card-title">Арендованные товары</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
            <thead>
            <tr>
            <th>Продукт</th>
            <th>Цена</th>
            <th>Аренд</th>
            <th></th>
            </tr>
            </thead>
            
            <tbody>
           

            <?php $__currentLoopData = $bestSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <img src="/Content/product/thumbnails/<?php echo e($product->thumbnail); ?>" alt="<?php echo e($product->name); ?>" class="img-circle img-size-32 mr-2">
                    <span class="name" title="<?php echo e($product->name); ?>"><?php echo e(\Illuminate\Support\Str::limit($product->name, 34)); ?></span>
                </td>
                <td><?php echo e($product->price, 0); ?> USD</td>
                <td>
                    <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                    </small>
                    <br>
                    <?php echo e($product->total_sales); ?> Rent
                </td>
                <td>
                    <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
            </tbody>
            </table>
            </div>
            <div class="card-footer text-center">
                <a href="javascript:void(0)" class="uppercase">Продукты для аренды</a>
                </div>
            </div>


        </div>
        
        </div>
        
        







        
        </div>
        <div class="card">
            <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
            </button>
            <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                <a href="#" class="dropdown-item">Action</a>
                <a href="#" class="dropdown-item">Another action</a>
                <a href="#" class="dropdown-item">Something else here</a>
                <a class="dropdown-divider"></a>
                <a href="#" class="dropdown-item">Separated link</a>
                </div>
                </div>
            </div>
            </div>
            
            <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table m-0">
            <thead>
            <tr>
            <th>Order ID</th>
            <th>Item</th>
            <th>Status</th>
            <th>Popularity</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><a href="pages/examples/invoice.html">OR9842</a></td>
            <td>Call of Duty IV</td>
            <td><span class="badge badge-success">Shipped</span></td>
            <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
            </td>
            </tr>
            <tr>
            <td><a href="pages/examples/invoice.html">OR1848</a></td>
            <td>Samsung Smart TV</td>
            <td><span class="badge badge-warning">Pending</span></td>
            <td>
            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
            </td>
            </tr>
            <tr>
            <td><a href="pages/examples/invoice.html">OR7429</a></td>
            <td>iPhone 6 Plus</td>
            <td><span class="badge badge-danger">Delivered</span></td>
            <td>
            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
            </td>
            </tr>
            <tr>
            <td><a href="pages/examples/invoice.html">OR7429</a></td>
            <td>Samsung Smart TV</td>
            <td><span class="badge badge-info">Processing</span></td>
            <td>
            <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
            </td>
            </tr>
            <tr>
            <td><a href="pages/examples/invoice.html">OR1848</a></td>
            <td>Samsung Smart TV</td>
            <td><span class="badge badge-warning">Pending</span></td>
            <td>
            <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
            </td>
            </tr>
            <tr>
            <td><a href="pages/examples/invoice.html">OR7429</a></td>
            <td>iPhone 6 Plus</td>
            <td><span class="badge badge-danger">Delivered</span></td>
            <td>
            <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
            </td>
            </tr>
            <tr>
            <td><a href="pages/examples/invoice.html">OR9842</a></td>
            <td>Call of Duty IV</td>
            <td><span class="badge badge-success">Shipped</span></td>
            <td>
            <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
            </td>
            </tr>
            </tbody>
            </table>
            </div>
            
            </div>
            
            <div class="card-footer clearfix">
            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
            <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            
            </div>
        </div>

        <script>
          document.addEventListener("DOMContentLoaded", function() {
  // Генерация случайных данных
  var newOrders = getRandomNumber(100, 300);
  var bounceRate = getRandomNumber(30, 70);
  var userRegistrations = getRandomNumber(20, 50);
  var uniqueVisitors = getRandomNumber(50, 100);

  // Обновление данных на графиках
  document.querySelector('.small-box.bg-info .inner h3').textContent = newOrders;
  document.querySelector('.small-box.bg-success .inner h3').textContent = `${bounceRate}%`;
  document.querySelector('.small-box.bg-warning .inner h3').textContent = userRegistrations;
  document.querySelector('.small-box.bg-danger .inner h3').textContent = uniqueVisitors;

  // Настройка графика visitors-chart
  var visitorsChart = document.getElementById("visitors-chart").getContext("2d");
  var visitorsData = generateRandomData(12, 500, 1000);
  var visitorsLabels = generateLabels(12);

  new Chart(visitorsChart, {
    type: 'line',
    data: {
      labels: visitorsLabels,
      datasets: [{
        data: visitorsData,
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        label: 'Visitors Over Time'
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Month'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Visitors'
          }
        }
      }
    }
  });

  // Служебные функции для генерации случайных данных и меток
  function getRandomNumber(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  }

  function generateRandomData(count, min, max) {
    var data = [];
    for (var i = 0; i < count; i++) {
      data.push(getRandomNumber(min, max));
    }
    return data;
  }

  function generateLabels(count) {
    var labels = [];
    for (var i = 1; i <= count; i++) {
      labels.push('Month ' + i);
    }
    return labels;
  }
});












document.addEventListener("DOMContentLoaded", function() {
  // Генерация случайных данных
  var salesAmount = getRandomNumber(10000, 20000);

  // Обновление данных на графиках
  document.querySelector('.card-body .d-flex .text-bold.text-lg').textContent = '$' + salesAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

  // Настройка графика sales-chart
  var salesChart = document.getElementById("sales-chart").getContext("2d");
  var salesData = generateRandomData(12, 10000, 20000);
  var salesLabels = generateLabels(12);
  var backgroundColors = generateBackgroundColors(12);

  new Chart(salesChart, {
    type: 'bar',
    data: {
      labels: salesLabels,
      datasets: [{
        data: salesData,
        backgroundColor: backgroundColors,
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        label: 'Sales Over Time'
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Month'
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Sales Amount'
          }
        }
      }
    }
  });

  // Служебные функции для генерации случайных данных и меток
  function getRandomNumber(min, max) {
    return Math.random() * (max - min) + min;
  }

  function generateRandomData(count, min, max) {
    var data = [];
    for (var i = 0; i < count; i++) {
      data.push(getRandomNumber(min, max));
    }
    return data;
  }

  function generateLabels(count) {
    var labels = [];
    for (var i = 1; i <= count; i++) {
      labels.push('Month ' + i);
    }
    return labels;
  }

  function generateBackgroundColors(count) {
    var backgroundColors = [];
    for (var i = 0; i < count; i++) {
      backgroundColors.push(i % 2 === 0 ? 'rgba(75, 192, 192, 0.2)' : 'rgba(128, 128, 128, 0.2)');
    }
    return backgroundColors;
  }
});



        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\maksi\Desktop\Мои_сайты\kitprotv\resources\views/admin/index.blade.php ENDPATH**/ ?>