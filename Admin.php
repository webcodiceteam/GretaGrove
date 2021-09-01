<?php

include 'header.php';

if (!isset($_SESSION["id"]))

{

    header("Location:index.php");

}

if($_SESSION["admin"]==false){

    header("Location:welcome.php");

}

?>

<style>

.inputCon {

    margin: 10px;

}



.m_center {

    text-align: center;

}

</style>

<div class="my_main_con">

    <div style="margin: 10px">

        <button type="button" class="btn btn-success mb-3" onclick="readRecords()">

            View Product

        </button>
        <button type="button" class="btn btn-success mb-3" onclick="openAddPModel()">

            Add Product

        </button>
    
        <button type="button" class="btn btn-success mb-3" onclick="readCategory()">

            View Category

        </button>
        <button type="button" class="btn btn-success mb-3 ml-1" onclick="openAddCModel()">

            Add Category

        </button>

        <button type="button" class="btn btn-success mb-3" onclick="readUser()">

            View User

        </button>

        <button type="button" class="btn btn-success mb-3 ml-1" onclick="openAddUModel()">

            Create User

        </button>

        <div id="records_contant"></div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

            aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">New Product</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                    <form id="addProductForm" action='javascript:void(0);' method="post" enctype="multipart/form-data">

                        <div class="modal-body">

                            <div>

                                <div class="inputCon">

                                    <input type="text" class="form-control" name="pName" id="pName"

                                        placeholder="Product Name" />

                                    <input type="hidden" name="action" value="INSERT_DATA" />

                                    <input type="hidden" class="form-control" name="pType" id="pType" value="0" />
                                    <input type="hidden" class="form-control" name="pId" id="pId" value="0" />

                                </div>

                                <div class="inputCon">

                                    <input type="text" class="form-control" name="pCode" id="pCode"

                                        placeholder="Product Code" />

                                </div>

                                <div class="inputCon">

                                    <input type="text" class="form-control" name="pQty" id="pQty"

                                        placeholder="Product QTY" />

                                </div>

                                <div class="inputCon">

                                    <input type="text" class="form-control" name="packQty" id="packQty"

                                        placeholder="Pack QTY" />

                                </div>

                                <div class="inputCon">

                                    <input type="text" class="form-control" name="disp" id="disp" placeholder="Disp" />

                                </div>

                                <div  class="inputCon">
                                    <select class="custom-select" aria-label="Default select example" name='category' id="cSelect">
                                        <option value='0'>Select Category</option>
                                        <?php
                                        
                                            $res = mysqli_query($conn, "SELECT * FROM jitendra_categorys");
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                    <option value='<?php echo $row['name']; ?>'><?php echo $row['name']; ?></option>
                                                <?php
                                            }
                                        
                                        ?>
                                    </select>
                                </div>

                                <div class="inputCon">

                                    <input type="file" class="form-control-file" name="pImage" id="pImage"

                                        placeholder="Add Product Image" />

                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">

                                Cancle

                            </button>

                            <button type="submit" class="btn btn-primary" id="pbtn">

                                Add Product

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
<div class="modal fade" id="CategoryModal" tabindex="-1" role="dialog" aria-labelledby="CategoryModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="CategoryModalLabel">New Category</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

            <div class="modal-body">
                <div class="inputCon">
                    <input type="text" class="form-control" name="cName" id="cName" placeholder="Category Name" />
                    <input type="hidden" class="form-control" name="type" id="cType" value="0" placeholder="Category Name" />
                    <input type="hidden" class="form-control" name="type" id="cId" value="0" placeholder="Category Name" />
                </div>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">

                    Cancle

                </button>

                <button type="button" onclick="addCategory()" class="btn btn-primary" id='cbtn'>

                    Add Category

                </button>

            </div>
    </div>

</div>

</div>
<div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="UserModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">

            <h5 class="modal-title" id="UserModalLabel">New User</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

            <div class="modal-body">
                <div class="inputCon">
                    <input type="text" class="form-control " name="FullName" id="FullName" placeholder="Enter Name" />
                </div>
                <div class="inputCon">
                    <input type="text" class="form-control" name="customer_company_name" id="customer_company_name" placeholder="Enter Company Cutomer Name" />
                </div>
                <div class="inputCon">
                    <input type="Email" class="form-control" name="email" id="email" placeholder="Enter Email" />
                </div>
                <div class="inputCon">
                    <input type="text" class="form-control" name="Address" id="Address" placeholder="Enter Address" />
                </div>
                <div class="inputCon">
                    <input type="text" class="form-control" name="Tel" id="Tel" placeholder="Enter Number" />
                </div>
                <div class="inputCon">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Set Password" />
                </div>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">

                    Cancle

                </button>

                <button type="button" onclick="adduserdatails()" class="btn btn-primary" id='cbtn'>

                    Create User

                </button>

            </div>
    </div>

</div>

</div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>

 let product = true;

$(document).ready(function() {

    readRecords();
    // readCategory();

});

openAddCModel = () =>{
    document.getElementById('cbtn').innerHTML = 'Add Category';
    $("#CategoryModal").modal("show");
}
openAddPModel = () =>{
    document.getElementById('pbtn').innerHTML = 'Add Product';
    $("#exampleModal").modal("show");
}

openAddUModel = () =>{
    $("#UserModal").modal("show");
}
GetCategoryDetails = (id) =>{
    $.ajax({

        url: "axios.php",

        type: "post",

        data: {
            action: 'getCategoryDetail',
            id
        },

        success: function(data, status) {
            let res = JSON.parse(data);
            $("#CategoryModal").modal("show");
            document.getElementById('cName').value = res.name;
            document.getElementById('cType').value = 1;
            document.getElementById('cId').value = id;
            document.getElementById('cbtn').innerHTML = 'Update Category';
        },

    });
}

adduserdatails = () =>{

    $.ajax({

        url: "axios.php",

        type: "post",

        data: {

            action: 'adduser',
            FullName: document.getElementById('FullName').value,
            customer_company_name: document.getElementById('customer_company_name').value,
            email: document.getElementById('email').value,
            Address: document.getElementById('Address').value,
            Tel: document.getElementById('Tel').value,
            password: document.getElementById('password').value,
        },

        success: function(data, status) {
            $("#UserModal").modal("hide");
            document.getElementById('FullName').value;
            document.getElementById('customer_company_name').value;
            document.getElementById('email').value;
            document.getElementById('Address').value;
            document.getElementById('password').value;
            document.getElementById('Tel').value;
            document.getElementById('ubtn').innerHTML = 'Add User';
        },

    });

}

GetProductDetails = (id) =>{
    $.ajax({

        url: "axios.php",

        type: "post",

        data: {
            action: 'getProductDetail',
            id
        },

        success: function(data, status) {
            let res = JSON.parse(data);
            $("#exampleModal").modal("show");
            document.getElementById('pName').value = res.pName;
            document.getElementById('pCode').value = res.pCode;
            document.getElementById('pQty').value = res.pQty;
            document.getElementById('packQty').value = res.packQty;
            document.getElementById('disp').value = res.disp;
            document.getElementById('cSelect').value = res.category;
            document.getElementById('pType').value = 1;
            document.getElementById('pId').value = id;
            document.getElementById('pbtn').innerHTML = 'Update Product';
        },

    });
}
addCategory = () =>{
    $.ajax({

        url: "axios.php",

        type: "post",

        data: {

            action: 'addCategory',
            name: document.getElementById('cName').value,
            cType: document.getElementById('cType').value,
            id: document.getElementById('cId').value

        },

        success: function(data, status) {
            $("#CategoryModal").modal("hide");
            readCategory();
            document.getElementById('cName').value = '';
            document.getElementById('cType').value = 0;
            document.getElementById('cId').value = 0;
            document.getElementById('cbtn').innerHTML = 'Add Category';
        },

    });
}


function readRecords() {

    var readrecord = "readrecord";

    $.ajax({

        url: "axios.php",

        type: "post",

        data: {

            action: 'readrecord'

        },

        success: function(data, status) {

            $("#records_contant").html(data);

        },

    });

}

readCategory = () =>{
    $.ajax({

        url: "axios.php",

        type: "post",

        data: {

            action: 'readCategory'

        },

        success: function(data, status) {

            $("#records_contant").html(data);

        },

    });
}

readUser = () =>{
    $.ajax({

        url: "axios.php",

        type: "post",

        data: {

            action: 'readUser'

        },

        success: function(data, status) {

            $("#records_contant").html(data);

        },

    });
}



$('#addProductForm').submit(function(e) {

    e.preventDefault();

    $.ajax({

        url: 'axios.php',

        type: "POST",

        data: new FormData(this),

        contentType: false,

        cache: false,

        processData: false,

        success: function(data) {

            $("#exampleModal").modal("hide");

            $('#msg').html(data);

            readRecords();
            document.getElementById('pName').value = '';
            document.getElementById('pCode').value = '';
            document.getElementById('pQty').value = '';
            document.getElementById('packQty').value = '';
            document.getElementById('disp').value = '';
            document.getElementById('cSelect').value = 0;
            document.getElementById('pType').value = 0;
            document.getElementById('pId').value = 0;
            document.getElementById('pbtn').innerHTML = 'Add Product';

        },

        error: function() {}

    });

});



function DeleteUser(deleteid) {

    var conf = confirm("Are you Sure");

    if (conf == true) {

        $.ajax({

            url: "axios.php",

            type: "post",

            data: {
                action:'DeleteProduct',
                deleteid: deleteid

            },

            success: function(data, status) {

                readRecords();

            },

        });

    }

}

function DeleteUserNew(deleteid) {

var conf = confirm("Are you Sure");

if (conf == true) {

    $.ajax({

        url: "axios.php",

        type: "post",

        data: {
            action:'DeleteUserNew',
            deleteid: deleteid

        },

        success: function(data, status) {

            readUser();

        },

    });

}

}



DeleteCategory = (deleteid) =>{
    var conf = confirm("Are you Sure");

    if (conf == true) {

        $.ajax({

            url: "axios.php",

            type: "post",

            data: {
                action:'delete_category',
                categoryId: deleteid

            },

            success: function(data, status) {

                readCategory();

            },

        });

    }
}

</script>

</body>



</html>

<?php include'footer.php'; ?>