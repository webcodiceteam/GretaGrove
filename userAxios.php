<?php
include 'config.php';
extract($_POST);

if($_POST['action'] == 'allCatg'){
    $res = mysqli_query($conn, "SELECT * FROM jitendra_produtcs");
    $i = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
          <div class="col-6 col-md-6 col-lg-4 mb-3">
            <div class="card h-100 border-0">
              <div class="card-img-top">
                <img
                  src="upload.images/<?php echo $row['pImage']; ?>"
                  style="width:240px;height:240px;border:1px solid;padding: 0 !important;"
                  class="img-fluid mx-auto d-block"
                  alt="Card image cap"
                />
              </div>
              <div class="card-body text-center">
                <h4 class="card-title">
                  <a
                    href="product.html"
                    class="font-weight-bold text-dark text-uppercase small"
                  >
                  <?php echo $row['pName']; ?></a
                  >
                </h4>
                <h4 class="card-price small">
                  <?php echo $row['category']; ?>
                </h4>
                <h5 class="card-price small text-warning">
                  <i>$<?php echo $row['disp']; ?></i>
                </h5>
                <div class="number my-2">
                  <span class="minus" style="background-color:red">-</span>
                  <input type="text" id="qty<?php echo $i; ?>" value="1"/>
                  <span class="plus" style="background-color:green">+</span>
                </div>
                <button class="btn btn-secondary btn-block" onclick="addToCart('<?php echo $row['id']; ?>','qty<?php echo $i; ?>')">Add To Cart</button>
              </div>
            </div>
          </div>
          <?php 
          $i++;
    }
    ?>
    
    <script>

$('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
</script>
    <?php
}

if($_POST['action'] == 'singCatg'){
    $name = $_POST['name'];
    $res = mysqli_query($conn, "SELECT * FROM jitendra_produtcs WHERE category='$name'");
    $i = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
          <div class="col-6 col-md-6 col-lg-4 mb-3">
            <div class="card h-100 border-0">
              <div class="card-img-top">
                <img
                  src="upload.images/<?php echo $row['pImage']; ?>"
                  style="width:240px;height:240px;border:1px solid;padding: 0 !important;"
                  class="img-fluid mx-auto d-block"
                  alt="Card image cap"
                />
              </div>
              <div class="card-body text-center">
                <h4 class="card-title">
                  <a
                    href="product.html"
                    class="font-weight-bold text-dark text-uppercase small"
                  >
                  <?php echo $row['pName']; ?></a
                  >
                </h4>
                <h5 class="card-price small text-warning">
                  <i>$<?php echo $row['disp']; ?></i>
                </h5>
                <div class="number my-2">
                  <span class="minus" style="background-color:red" >-</span>
                  <input id="qty<?php echo $i; ?>" type="text" value="1"/>
                  <span class="plus" style="background-color:green">+</span>
                </div>
                <button class="btn btn-secondary btn-block" onclick="addToCart('<?php echo $row['id']; ?>','qty<?php echo $i; ?>')">Add To Cart</button>
              </div>
            </div>
          </div>
          <?php 
          $i++;
    }
    ?>
        <script>

$('.minus').click(function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
  });
  $('.plus').click(function () {
    var $input = $(this).parent().find('input');
    $input.val(parseInt($input.val()) + 1);
    $input.change();
    return false;
  });
</script>
    
    <?php
}
if($_POST['action'] == 'addToCart'){
  $user_id = $_SESSION["id"];
  $product_id = $_POST['id'];
  $product_qty = $_POST['qty'];
  $res = mysqli_query($conn, "INSERT INTO jitendra_cart (user_id,product_id,product_qty) VALUES ('".$user_id."','".$product_id."','".$product_qty."')");
  echo $res;
}

if($_POST['action'] == 'getCartQty'){
  $user_id = $_SESSION["id"];
  $res = mysqli_query($conn, "SELECT * FROM jitendra_cart WHERE user_id='$user_id'");
  echo $res->num_rows;
}

if($_POST['action'] == 'removeFromCart'){
  $id = $_POST["id"];
  $res = mysqli_query($conn, "DELETE FROM jitendra_cart WHERE id='$id'");
  echo $res;
}

if($_POST['action'] == 'EmptyCart'){
  $user_id = $_SESSION["id"];
  $res = mysqli_query($conn, "DELETE FROM jitendra_cart WHERE user_id='$user_id'");
  echo $res;
}

if($_POST['action'] == 'getCart'){
  $res = mysqli_query($conn, "SELECT * FROM jitendra_cart WHERE user_id='".$_SESSION["id"]."'");
  while ($row = mysqli_fetch_assoc($res)) {
    $res2 = mysqli_query($conn, "SELECT * FROM jitendra_produtcs WHERE id='".$row['product_id']."'");
    while ($row2 = mysqli_fetch_assoc($res2)) {
?>
  <tr>
      <td>
          <div class="product-item">
              <a class="product-thumb" href="#"><img style="border: 1px solid black;height:100px;width:100px" src="upload.images/<?php echo $row2['pImage']; ?>" alt="Product"></a>
              <div class="product-info">
                  <h4 class="product-title"><?php echo $row2['pName']; ?></h4><span>
              </div>
          </div>
      </td>
      <td class="text-center">
          <div class="count-input">
            <?php echo $row['product_qty']; ?>
          </div>
      </td>
      <td class="text-center text-lg text-medium">$<?php echo $row2['disp']; ?></td>
      <td class="text-center"><a class="remove-from-cart" href="javascript:void(0)" onclick="removeFromCart('<?php echo $row['id']; ?>')" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="bi bi-trash"></i></a></td>
  </tr>
  <?php }}
}


?>