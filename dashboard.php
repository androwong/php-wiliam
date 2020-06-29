<?php
include_once("build/header.php");
?>
<h1 class="h3 mb-4 text-gray-800">Dashboard <small><?php echo ucfirst($_SERVER['HTTP_HOST']); ?></small></h1>
<div class="row">
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card text-gray-900 shadow h-100 py-2 border-0">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Brands</div>
                  <div class="h4 mb-0 font-weight-bold"><?php $result = mysqli_query($mysqli,"SELECT * FROM brands"); $num_rows = mysqli_num_rows($result); echo "$num_rows" ?></div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-star fa-2x"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card text-gray-900 shadow h-100 py-2 border-0">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Users</div>
                  <div class="h4 mb-0 font-weight-bold"><?php $result = mysqli_query($mysqli,"SELECT * FROM admins"); $num_rows = mysqli_num_rows($result); echo "$num_rows" ?></div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-user fa-2x"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
include_once("build/footer.php");
?>
