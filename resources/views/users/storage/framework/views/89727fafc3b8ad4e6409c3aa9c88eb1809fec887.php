
<?php $__env->startSection('style'); ?>
<style>
    
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="">

<div class="container">
    
    <div class="row">
        <div class="mx-auto" style="width: max-content; max-width: 100%;">
            <a href="/users" class="bg-primary bg-gradient p-3 rounded d-inline-block m-1 w-card text-decoration-none">
                <div class="d-flex justify-content-between">
                    <div class="text-white">
                        <ion-icon class="fs-icon"
                         name="person-outline"></ion-icon>
                    </div>
                    <div class="text-white text text-end">
                        <h3 class="fs-2" id="admin-count">-</h3>
                        <h6>ADMIN</h6>
                    </div>
                </div>
            </a>
            <a href="/users" class="bg-success bg-gradient p-3 rounded d-inline-block m-1 w-card text-decoration-none">
                <div class="d-flex justify-content-between">
                    <div class="text-white">
                        <ion-icon class="fs-icon"
                         name="person-circle-outline"></ion-icon>
                    </div>
                    <div class="text-white text text-end">
                        <h3 class="fs-2" id="cashier-count">-</h3>
                        <h6>CASHIER</h6>
                    </div>
                </div>
            </a>
            <a href="/products" class="bg-info bg-gradient p-3 rounded d-inline-block m-1 w-card text-decoration-none">
                <div class="d-flex justify-content-between">
                <div class="text-white">
                     <ion-icon class="fs-icon" name="layers-outline"></ion-icon>
                </div>
                <div class="text-white text text-end">
                    <h3 class="fs-2" id="product-count">-</h3>
                    <h6>PRODUCTS</h6>
                </div>
            </div>
            </a>
            <a href="" class="bg-secondary bg-gradient p-3 rounded d-inline-block m-1 w-card text-decoration-none">
                <div class="d-flex justify-content-between">
                <div class="text-white">
                     <ion-icon class="fs-icon" name="people-outline"></ion-icon>
                </div>
                <div class="text-white text text-end">
                    <h3 class="fs-2" id="supplier-count">-</h3>
                    <h6>SUPPLIERS</h6>
                </div>
            </div>
            </a>
            <a href="" class="bg-primary bg-gradient p-3 rounded d-inline-block m-1 w-card text-decoration-none">
                <div class="d-flex justify-content-between">
                <div class="text-white flex">
                     <ion-icon class="fs-icon" name="cart-outline"></ion-icon>
                </div>
                <div class="text-white text text-end">
                    <h3 class="fs-2" id="order-count">-</h3>
                    <h6>ORDERS</h6>
                </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-lg-6 py-1 px-1">
            <div class="">
                <canvas id="productChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6 py-1 px-1" style="height: 15rem">
            <div class="bg-primary" style="height: 100%">

            </div>
        </div>
        <div class="py-1 px-1" style="height: 15rem">
            <div class="bg-info" style="height: 100%">

            </div>
        </div>
    </div>
</div>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    
function getProducts(){
    $.get("/api/product", function(response){
        const products = response.data;
        var totalProducts = 0;
        var productNames = [];
        var productQuantity = [];
        var productChart = document.getElementById('productChart').getContext('2d');
        // console.log(products);
        for(var i = 0; i < products.length; i++){
            totalProducts++;
            productNames[i] = products[i].product_name;
            productQuantity[i] = products[i].quantity;
        }
        
        var myChart = new Chart(productChart, {
            type: 'bar',
            data: {
                labels: productNames,
                datasets: [{
                    label: 'Products',
                    data: productQuantity,
                    backgroundColor: [
                        'rgba(34, 230, 216, 0.5)',
                    ],
                    borderColor: [
                        'rgba(34, 230, 216, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $("#product-count").html(totalProducts);
    });
}

function getUsers(){
    $.get("/api/users", function(response){
        const users = response.data;
        var adminCount = 0;
        var cashierCount = 0;
        // console.log(users);
        for(var i = 0; i < users.length; i++){
            if(users[i].is_admin == 2){
                adminCount++;
                continue;
            }
            cashierCount++;
        }
        $("#admin-count").html(adminCount);
        $("#cashier-count").html(cashierCount);
    });    
}

function getSuppliers(){
    $.get("/api/suppliers", function(response){
        const suppliers = response.data;
        var supplierCount = 0;
        
        // console.log(suppliers);
        for(var i = 0; i < suppliers.length; i++){
            supplierCount++;
        }
        $("#supplier-count").html(supplierCount);
    }); 
}

function getOrders(){
    $.get("/api/orders", function(response){
        const orders = response.data;
        var orderCount = 0;
        
        // console.log(users);
        for(var i = 0; i < orders.length; i++){
            orderCount++;
        }
        $("#order-count").html(orderCount);
    }); 
}

$(document).ready(function(){
    getProducts();
    getUsers();
    getSuppliers();
    getOrders();
})
    
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\POS\resources\views/dashboard.blade.php ENDPATH**/ ?>