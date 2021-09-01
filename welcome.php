<?php

include 'header.php';

    if (!isset($_SESSION["id"]))

    {

        header("Location:index.php");

    }
    ?>
<link
  href="https://fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet"
/>
<style>
  .btn-secondary{
    background-color: #343a40;
    border-color: #343a40;
  }

  span {cursor:pointer; }
		.number{
			/* margin:100px; */
		}
		.minus, .plus{
			width:30px;
			height:30px;
			background:#f2f2f2;
      color:white;
      font-size:20px;
			border-radius:4px;
			/* padding:8px 5px 8px 5px; */
			border:1px solid #ddd;
      display: inline-block;
      vertical-align: middle;
      text-align: center;
		}
		input{
			height:34px;
      width: 100px;
      text-align: center;
      font-size: 20px;
			border:1px solid #ddd;
			border-radius:4px;
      display: inline-block;
      vertical-align: middle;
    }
</style>
<div style="min-height: 80vh; max-width:98%;">
  <div class="row my-4">
    <div class="col-md-9 order-md-2 col-lg-9">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-12">
            <div class="dropdown float-right">
              <a href="order.php" type="button" class="btn btn-secondary">
               View Cart <span class="badge badge-light" id="cartNo">0</span>
              </a>
            </div>
          </div>
        </div>
        <div class="row" id="product_div">
        </div>
        <div class="row sorting mb-5 mt-5">
          <!-- Footer -->
        </div>
      </div>
    </div>
    <div class="col-md-3 order-md-1 col-lg-3 sidebar-filter">
      <h6 class="text-uppercase font-weight-bold mb-3">Categories</h6>
      <div class="mt-2 mb-2 pl-2">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="cate" class="custom-control-input" id="category-0" checked />
          <label class="custom-control-label" onclick="getAllProducts()" for="category-0">All</label>
        </div>
      </div>
      <?php
        $res = mysqli_query($conn, "SELECT * FROM jitendra_categorys");
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="cate" class="custom-control-input" id="category-<?php echo $i; ?>" />
                    <label class="custom-control-label" onclick="showSingleCatg('<?php echo $row['name']; ?>','category-<?php echo $i; ?>')" for="category-<?php echo $i; ?>"><?php echo $row['name']; ?></label>
                </div>
            </div>
            <?php
            $i++;
        }
      ?>
      <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="./js/main.js"></script>
<script>
    $('input[type="checkbox"]').on('change', function() {
      $('input[name="' + this.name + '"]').not(this).prop('checked', false);
    });
    getAllProducts = () =>{
        $.ajax({
            url: "userAxios.php",
            type: "post",
            data: {
                action:'allCatg',
            },
            success: function(data, status) {
                $('#product_div').html(data);
                getCartValue()
            },
        });
    }

    getAllProducts();

    getCartValue = () =>{
      $.ajax({
            url: "userAxios.php",
            type: "post",
            data: {
                action:'getCartQty',
            },
            success: function(data, status) {
              document.getElementById('cartNo').innerHTML = data;
            },
      });
    }

    showSingleCatg = (name,id) =>{
        $.ajax({
            url: "userAxios.php",
            type: "post",
            data: {
                action:'singCatg',
                name,
            },
            success: function(data, status) {
                $('#product_div').html(data);
            },
        });
    }
    addToCart = (id,q) =>{
      let cartNo = document.getElementById('cartNo');
      cartNo.innerHTML = parseInt(cartNo.innerHTML) + 1;
      $.ajax({
            url: "userAxios.php",
            type: "post",
            data: {
                action:'addToCart',
                id,
                qty:document.getElementById(q).value
            },
            success: function(data, status) {
               console.log(data)
            },
      });
    }
</script>

<?php 

include 'footer.php';

?>
