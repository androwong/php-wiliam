<?php
$function = ucwords($_GET["function"]);
$table = $_GET["table"];
$table_title = ucwords(preg_replace('/-+/', ' ', preg_replace('/[^A-Za-z0-9\-]/', ' ', $table)));
if(isset($_GET["id"])) {
   $id = $_GET["id"];
}
include_once("build/header.php");
?>
<h1 class="h3 mb-4 text-gray-800"><?php echo $function; if($_GET["function"] == "add") { echo " new"; } ?> (<?php echo $table_title; ?>) <small><?php echo ucfirst($_SERVER['HTTP_HOST']); ?></small></h1>
<div class="row">
   <?php if($_GET["function"] == "all") { ?>
   <div class="col-lg-12">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $function; ?> (<?php echo $table_title; ?>)</h6>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <?php if($_GET["table"] == "brands") { ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>Brand</th>
                           <th>Bonus</th>
                           <th>Rating</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $query = mysqli_query($mysqli,"select * from brands"); if ($query) {
                           while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                           <td class="align-middle"><?php echo $row["title"] ?></td>
                           <td class="align-middle">£<?php echo $row["value"] ?></td>
                           <td class="d-flex justify-content-between align-items-center">
                              <?php echo $row["rating"] ?> stars
                              <div class="dropdown">
                                 <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                 Actions
                                 </button>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" href="db?function=edit&table=brands&id=<?php echo $row["brand_id"] ?>"><i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i> Edit brand</a>
                                    <a class="dropdown-item" href="php/process?table=brands&delete=<?php echo $row["brand_id"] ?>"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Delete brand</a>
                                 </div>
                              </div>
                           </td>
                        </tr>
                        <?php } } ?>
                     </tbody>
                  </table>
               <?php }
               if($_GET["table"] == "admins") { ?>
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                           <th>Admin</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $query = mysqli_query($mysqli,"select * from admins"); if ($query) {
                           while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
                        ?>
                        <tr>
                           <td class="d-flex justify-content-between align-items-center">
                              <?php echo $row["first_name"].' '.$row["last_name"]; ?>
                              <div class="dropdown">
                                 <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                 Actions
                                 </button>
                                 <div class="dropdown-menu">
                                    <a class="dropdown-item" href="db?function=edit&table=admins&id=<?php echo $row["admin_id"] ?>"><i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-400"></i> Edit admin</a>
                                    <?php if($row["admin_id"] <> '1') { echo '<a class="dropdown-item" href="php/process?table=admins&delete='.$row["admin_id"].'"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Delete admin</a>'; } ?>
                                 </div>
                              </div>
                           </td>
                        </tr>
                        <?php } } ?>
                     </tbody>
                  </table>
               <?php } ?>
               <div id="msg"></div>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <?php if($_GET["function"] <> "all") { ?>
   <div class="col-lg-6">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $function; ?> (<?php echo $table_title; ?>)</h6>
         </div>
         <div class="card-body">
            <?php if($_GET["function"] == "add") {
               if($_GET["table"] == "brands") { ?>
                  <form action="/admin/php/process.php" method="post" id="form">
                     <input type="hidden" name="submit" value="add_brand">
                     <input type="hidden" name="task" value="insert">
                     <input type="hidden" name="id" value="">
                     <div class="form-group">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control" placeholder="Brand name" required>
                     </div>
                     <div class="form-group">
                        <label>Offer Tagline</label>
                        <input type="text" name="tagline" class="form-control" placeholder="Bet £10 Get £30" required>
                     </div>
                     <div class="form-group">
                        <label>Offer Value</label>
                        <input type="number" name="value" class="form-control" placeholder="30" required>
                     </div>
                     <div class="form-group">
                        <label>Offer Type</label>
                        <input type="text" name="type" class="form-control" placeholder="Free Bet" required>
                     </div>
                     <div class="form-group">
                        <label>Promo Code</label>
                        <input type="text" name="code" class="form-control" placeholder="PC100" required>
                     </div>
                     <div class="form-group">
                        <label>Affiliate URL</label>
                        <input type="text" name="url" class="form-control" placeholder="Affiliate URL" required>
                     </div>
                     <div class="form-group">
                        <label>Rating</label>
                        <select name="rating" class="custom-select form-control" required>
                           <option value="1">1</option>
                           <option value="1.1">1.1</option>
                           <option value="1.2">1.2</option>
                           <option value="1.3">1.3</option>
                           <option value="1.4">1.4</option>
                           <option value="1.5">1.5</option>
                           <option value="1.6">1.6</option>
                           <option value="1.7">1.7</option>
                           <option value="1.8">1.8</option>
                           <option value="1.9">1.9</option>
                           <option value="2">2</option>
                           <option value="2.1">2.1</option>
                           <option value="2.2">2.2</option>
                           <option value="2.3">2.3</option>
                           <option value="2.4">2.4</option>
                           <option value="2.5">2.5</option>
                           <option value="2.6">2.6</option>
                           <option value="2.7">2.7</option>
                           <option value="2.8">2.8</option>
                           <option value="2.9">2.9</option>
                           <option value="3">3</option>
                           <option value="3.1">3.1</option>
                           <option value="3.2">3.2</option>
                           <option value="3.3">3.3</option>
                           <option value="3.4">3.4</option>
                           <option value="3.5">3.5</option>
                           <option value="3.6">3.6</option>
                           <option value="3.7">3.7</option>
                           <option value="3.8">3.8</option>
                           <option value="3.9">3.9</option>
                           <option value="4">4</option>
                           <option value="4.1">4.1</option>
                           <option value="4.2">4.2</option>
                           <option value="4.3">4.3</option>
                           <option value="4.4">4.4</option>
                           <option value="4.5">4.5</option>
                           <option value="4.6">4.6</option>
                           <option value="4.7">4.7</option>
                           <option value="4.8">4.8</option>
                           <option value="4.9">4.9</option>
                           <option value="5">5</option>
                           <option value="5.1">5.1</option>
                           <option value="5.2">5.2</option>
                           <option value="5.3">5.3</option>
                           <option value="5.4">5.4</option>
                           <option value="5.5">5.5</option>
                           <option value="5.6">5.6</option>
                           <option value="5.7">5.7</option>
                           <option value="5.8">5.8</option>
                           <option value="5.9">5.9</option>
                           <option value="6">6</option>
                           <option value="6.1">6.1</option>
                           <option value="6.2">6.2</option>
                           <option value="6.3">6.3</option>
                           <option value="6.4">6.4</option>
                           <option value="6.5">6.5</option>
                           <option value="6.6">6.6</option>
                           <option value="6.7">6.7</option>
                           <option value="6.8">6.8</option>
                           <option value="6.9">6.9</option>
                           <option value="7">7</option>
                           <option value="7.1">7.1</option>
                           <option value="7.2">7.2</option>
                           <option value="7.3">7.3</option>
                           <option value="7.4">7.4</option>
                           <option value="7.5">7.5</option>
                           <option value="7.6">7.6</option>
                           <option value="7.7">7.7</option>
                           <option value="7.8">7.8</option>
                           <option value="7.9">7.9</option>
                           <option value="8">8</option>
                           <option value="8.1">8.1</option>
                           <option value="8.2">8.2</option>
                           <option value="8.3">8.3</option>
                           <option value="8.4">8.4</option>
                           <option value="8.5">8.5</option>
                           <option value="8.6">8.6</option>
                           <option value="8.7">8.7</option>
                           <option value="8.8">8.8</option>
                           <option value="8.9">8.9</option>
                           <option value="9">9</option>
                           <option value="9.1">9.1</option>
                           <option value="9.2">9.2</option>
                           <option value="9.3">9.3</option>
                           <option value="9.4">9.4</option>
                           <option value="9.5">9.5</option>
                           <option value="9.6">9.6</option>
                           <option value="9.7">9.7</option>
                           <option value="9.8">9.8</option>
                           <option value="9.9">9.9</option>
                           <option value="10">10</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" rows="7" placeholder="Add a review for this brand..."></textarea>
                     </div>
                     <div class="form-group">
                        <label>Terms</label>
                        <textarea type="text" name="terms" class="form-control" rows="7" placeholder="Offer T&C's..."></textarea>
                     </div>
                     <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="img" class="form-control-file">
                     </div>
                     <button type="submit" class="btn btn-primary btn-block">Add brand</button>
                     <div id="msg"></div>
                  </form>
               <?php }
               if($_GET["table"] == "admins") { ?>
                  <form action="/admin/php/process.php" method="post" id="form">
                     <input type="hidden" name="submit" value="add_admin">
                     <input type="hidden" name="task" value="insert">
                     <input type="hidden" name="id" value="">
                     <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First name" required>
                     </div>
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="First name" required>
                     </div>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" class="btn btn-primary btn-block">Add admin</button>
                     <div id="msg"></div>
                  </form>
               <?php }
            }
            if($_GET["function"] == "edit") {
               if($_GET["table"] == "brands") {
                  $query = mysqli_query($mysqli,"select * from brands WHERE brand_id = $id"); if ($query) {
                     while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
               ?>
                  <form action="/admin/php/process.php" method="post" id="form">
                     <input type="hidden" name="submit" value="add_brand">
                     <input type="hidden" name="task" value="update">
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <div class="form-group">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control" placeholder="Brand name" value="<?php echo $row["title"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Offer Tagline</label>
                        <input type="text" name="tagline" class="form-control" placeholder="Bet £10 Get £30" value="<?php echo $row["tagline"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Offer Value</label>
                        <input type="number" name="value" class="form-control" placeholder="30" value="<?php echo $row["value"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Offer Type</label>
                        <input type="text" name="type" class="form-control" placeholder="Free Bet" value="<?php echo $row["type"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Promo Code</label>
                        <input type="text" name="code" class="form-control" placeholder="PC100" value="<?php echo $row["code"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Affiliate URL</label>
                        <input type="text" name="url" class="form-control" placeholder="Affiliate URL" value="<?php echo $row["url"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Rating</label>
                        <select name="rating" class="custom-select form-control" required>
                           <option value="<?php echo $row["rating"]; ?>"><?php echo $row["rating"]; ?></option>
                           <option value="1">1</option>
                           <option value="1.1">1.1</option>
                           <option value="1.2">1.2</option>
                           <option value="1.3">1.3</option>
                           <option value="1.4">1.4</option>
                           <option value="1.5">1.5</option>
                           <option value="1.6">1.6</option>
                           <option value="1.7">1.7</option>
                           <option value="1.8">1.8</option>
                           <option value="1.9">1.9</option>
                           <option value="2">2</option>
                           <option value="2.1">2.1</option>
                           <option value="2.2">2.2</option>
                           <option value="2.3">2.3</option>
                           <option value="2.4">2.4</option>
                           <option value="2.5">2.5</option>
                           <option value="2.6">2.6</option>
                           <option value="2.7">2.7</option>
                           <option value="2.8">2.8</option>
                           <option value="2.9">2.9</option>
                           <option value="3">3</option>
                           <option value="3.1">3.1</option>
                           <option value="3.2">3.2</option>
                           <option value="3.3">3.3</option>
                           <option value="3.4">3.4</option>
                           <option value="3.5">3.5</option>
                           <option value="3.6">3.6</option>
                           <option value="3.7">3.7</option>
                           <option value="3.8">3.8</option>
                           <option value="3.9">3.9</option>
                           <option value="4">4</option>
                           <option value="4.1">4.1</option>
                           <option value="4.2">4.2</option>
                           <option value="4.3">4.3</option>
                           <option value="4.4">4.4</option>
                           <option value="4.5">4.5</option>
                           <option value="4.6">4.6</option>
                           <option value="4.7">4.7</option>
                           <option value="4.8">4.8</option>
                           <option value="4.9">4.9</option>
                           <option value="5">5</option>
                           <option value="5.1">5.1</option>
                           <option value="5.2">5.2</option>
                           <option value="5.3">5.3</option>
                           <option value="5.4">5.4</option>
                           <option value="5.5">5.5</option>
                           <option value="5.6">5.6</option>
                           <option value="5.7">5.7</option>
                           <option value="5.8">5.8</option>
                           <option value="5.9">5.9</option>
                           <option value="6">6</option>
                           <option value="6.1">6.1</option>
                           <option value="6.2">6.2</option>
                           <option value="6.3">6.3</option>
                           <option value="6.4">6.4</option>
                           <option value="6.5">6.5</option>
                           <option value="6.6">6.6</option>
                           <option value="6.7">6.7</option>
                           <option value="6.8">6.8</option>
                           <option value="6.9">6.9</option>
                           <option value="7">7</option>
                           <option value="7.1">7.1</option>
                           <option value="7.2">7.2</option>
                           <option value="7.3">7.3</option>
                           <option value="7.4">7.4</option>
                           <option value="7.5">7.5</option>
                           <option value="7.6">7.6</option>
                           <option value="7.7">7.7</option>
                           <option value="7.8">7.8</option>
                           <option value="7.9">7.9</option>
                           <option value="8">8</option>
                           <option value="8.1">8.1</option>
                           <option value="8.2">8.2</option>
                           <option value="8.3">8.3</option>
                           <option value="8.4">8.4</option>
                           <option value="8.5">8.5</option>
                           <option value="8.6">8.6</option>
                           <option value="8.7">8.7</option>
                           <option value="8.8">8.8</option>
                           <option value="8.9">8.9</option>
                           <option value="9">9</option>
                           <option value="9.1">9.1</option>
                           <option value="9.2">9.2</option>
                           <option value="9.3">9.3</option>
                           <option value="9.4">9.4</option>
                           <option value="9.5">9.5</option>
                           <option value="9.6">9.6</option>
                           <option value="9.7">9.7</option>
                           <option value="9.8">9.8</option>
                           <option value="9.9">9.9</option>
                           <option value="10">10</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control" rows="7" placeholder="Add a review for this brand..."><?php echo $row["description"]; ?></textarea>
                     </div>
                     <div class="form-group">
                        <label>Terms</label>
                        <textarea type="text" name="terms" class="form-control" rows="7" placeholder="Offer T&C's..."><?php echo $row["terms"]; ?></textarea>
                     </div>
                     <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="img" class="form-control-file">
                     </div>
                     <button type="submit" class="btn btn-primary btn-block">Update brand</button>
                     <div id="msg"></div>
                  </form>
               <?php } } }
               if($_GET["table"] == "admins") {
                  $query = mysqli_query($mysqli,"select * from admins WHERE admin_id = $id"); if ($query) {
                     while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
               ?>
                  <form action="/admin/php/process.php" method="post" id="form">
                     <input type="hidden" name="submit" value="add_admin">
                     <input type="hidden" name="task" value="update">
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First name" value="<?php echo $row["first_name"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="First name" value="<?php echo $row["last_name"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $row["username"]; ?>" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $row["password"]; ?>" required>
                     </div>
                     <button type="submit" class="btn btn-primary btn-block">Update admin</button>
                     <div id="msg"></div>
                  </form>
               <?php } } }
            } ?>
         </div>
      </div>
   </div>
   <?php } ?>
</div>
<?php
include_once("build/footer.php");
?>
