<?php 

include 'config.php';  

extract($_POST);

if($_POST['action'] == 'getCategoryDetail'){
  $res = mysqli_query($conn, "SELECT * FROM jitendra_categorys Where id=".$_POST['id']);
  while ($row = mysqli_fetch_assoc($res)) {
    $arr = $row;
  } 
  print_r(json_encode($arr));
}

if($_POST['action'] == 'getProductDetail'){
  $res = mysqli_query($conn, "SELECT * FROM jitendra_produtcs Where id=".$_POST['id']);
  while ($row = mysqli_fetch_assoc($res)) {
    $arr = $row;
  } 
  print_r(json_encode($arr));
}

if($_POST['action'] == 'readCategory') { 
  $data = '<table class="table table-borderd table-striped">
<tr>
  <th class="m_center">No.</th>

  <th class="m_center">Category Name</th>

  <th class="m_center">Edit Action</th>

  <th class="m_center">Delete Action</th>

  </tr>';

  $displayquery = " SELECT * FROM `jitendra_categorys` ";

  $result = mysqli_query($conn,$displayquery);





  if(mysqli_num_rows($result) > 0)

  {



    $number = 1;

    while ($row = mysqli_fetch_array($result)) {

      $data .='<tr>
      <td class="m_center">'.$number.'</td>

      <td class="m_center">'.$row['name'].'</td>

      <td class="m_center">

      <button onclick="GetCategoryDetails('.$row['id'].')" class="btn btn-warning">Edit</button>

      </td>

      <td class="m_center">

      <button onclick="DeleteCategory('.$row['id'].')" class="btn btn-danger">Delete</button>

      </td>

      </tr>';

      $number++;

    }

  }

  $data .= '</table>';

  echo $data;

}


if($_POST['action'] == 'readUser') { 
  $data = '<table class="table table-borderd table-striped table-responsive-sm table-responsive-md table-responsive-lg">
  <tr>
  <th class="m_center">No.</th>

  <th class="m_center">Name</th>
  <th class="m_center">Company Name</th>
  <th class="m_center">Email</th>
  <th class="m_center">Tel no.</th>
  <th class="m_center">Role</th>

  <th class="m_center">Delete Action</th>

  </tr>';

  $displayquery = " SELECT * FROM `jitendra_login` ";

  $result = mysqli_query($conn,$displayquery);





  if(mysqli_num_rows($result) > 0)

  {



    $number = 1;

    while ($row = mysqli_fetch_array($result)) {

      $data .='<tr>
      <td class="m_center">'.$number.'</td>

      <td class="m_center">'.$row['FullName'].'</td>
      <td class="m_center">'.$row['customer_company_name'].'</td>
      <td class="m_center">'.$row['email'].'</td>
      <td class="m_center">'.$row['Tel'].'</td>
      <td class="m_center">'.$row['role'].'</td>
      <td class="m_center">

      <button onclick="DeleteUserNew('.$row['id'].')" class="btn btn-danger">Delete</button>

      </td>

      </tr>';

      $number++;

    }

  }

  $data .= '</table>';

  echo $data;

}


if($_POST['action'] == 'readrecord') {

  $data = '<table class="table table-borderd table-striped table-responsive-sm table-responsive-md table-responsive-lg ">

  <tr>

  <th class="m_center">No.</th>

  <th class="m_center"> Product Name</th>

  <th class="m_center">Product Code</th>

  <th class="m_center">Product Quantity</th>

  <th class="m_center">Pacage  Quantity</th>

  <th class="m_center">Disp</th>

  <th class="m_center" style="width:10%">Category</th>
  
  <th class="m_center">Image</th>

  <th class="m_center">Edit Action</th>

  <th class="m_center">Delete Action</th>

  </tr>';

  $displayquery = " SELECT * FROM `jitendra_produtcs` ";

  $result = mysqli_query($conn,$displayquery);





  if(mysqli_num_rows($result) > 0)

  {



    $number = 1;

    while ($row = mysqli_fetch_array($result)) {

      $data .='<tr>

      <td class="m_center">'.$number.'</td>

      <td class="m_center">'.$row['pName'].'</td>

      <td class="m_center">'.$row['pCode'].'</td>

      <td class="m_center">'.$row['pQty'].'</td>

      <td class="m_center">'.$row['packQty'].'</td>

      <td class="m_center">'.$row['disp'].'</td>

      <td class="m_center">'.$row['category'].'</td>
      
      <td class="m_center"><img src="upload.images/'.$row['pImage'] .'" height="50" width="50"/></td>

      <td class="m_center">

      <button onclick="GetProductDetails('.$row['id'].')" class="btn btn-warning">Edit</button>

      </td>

      <td class="m_center">

      <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>

      </td>

      </tr>';

      $number++;

    }

  }

  $data .= '</table>';

  echo $data;

}

if($_POST['action'] == 'INSERT_DATA'){

    $prod_name = $_POST['pName'];

    $prod_code = $_POST['pCode'];

    $prod_pQty = $_POST['pQty'];

    $prod_packQty = $_POST['packQty'];

    $prod_disp = $_POST['disp'];
    
    $category = $_POST['category'];

    $name = $_FILES['pImage']['name'];

    if($name == ''){
      $name = 'no';
    }else{

      $tmp_name = $_FILES['pImage']['tmp_name'];
  
      $path = 'upload.images/';
  
      if(!empty($name)){
  
      move_uploaded_file($tmp_name,$path.$name);
  
      echo "Upload successfully";
  
      }else{
  
      echo "Please choose a file";
  
      }
    }


    if($_POST['pType'] == 1){
      if($name == 'no'){
        $res = mysqli_query($conn, "UPDATE jitendra_produtcs SET pName ='$prod_name' , pCode='$prod_code' , pQty='$prod_pQty' , packQty='$prod_packQty' , disp='$disp' , category='$category'  WHERE id=".$_POST['pId']);
      }else{
        $res = mysqli_query($conn, "UPDATE jitendra_produtcs SET pName ='$prod_name' , pCode='$prod_code' , pQty='$prod_pQty' , packQty='$prod_packQty' , disp='$disp' , pImage='$name' , category='$category'  WHERE id=".$_POST['pId']);
      }
    }else{
      $sql=" INSERT INTO `jitendra_produtcs`(`pName`, `pCode`, `pQty`, `packQty`,`disp`, `pImage`,`category`) VALUES ('$prod_name','$prod_code','$prod_pQty','$prod_packQty','$disp', '$name', '$category')";
      mysqli_query($conn,$sql);
    }


}

  /////delete user recors



if($_POST['action'] == 'DeleteProduct')
{

  $userid= $_POST['deleteid'];

  $deletequery = " delete from jitendra_produtcs where id='$userid' ";

  mysqli_query($conn,$deletequery);

}


if($_POST['action'] == 'DeleteUserNew')
{

  $userid= $_POST['deleteid'];

  $deletequery = " delete from jitendra_login where id='$userid' ";

  mysqli_query($conn,$deletequery);

}

if($_POST['action'] == 'addCategory'){
  $name = $_POST['name'];
  if($_POST['cType'] == 1){
    $res = mysqli_query($conn, "UPDATE jitendra_categorys SET name ='$name' WHERE id=".$_POST['id']);
  }else{
    $res = mysqli_query($conn, "INSERT INTO jitendra_categorys (name) VALUES ('".$name."')");
  }
  echo $res;
}

if($_POST['action'] == 'delete_category'){
  $userid= $_POST['categoryId'];

  $deletequery = "delete from jitendra_categorys where id='$userid' ";

  mysqli_query($conn,$deletequery);
}

if($_POST['action'] == 'adduser'){
  $stu_name = $_POST['FullName'];
  $stu_comapany = $_POST['customer_company_name'];
  $stu_email = $_POST['email'];
  $stu_address = $_POST['Address'];
  $stu_tel = $_POST['Tel'];
  $stu_role = 'user';
  $stu_password = md5($_POST['password']);
  $sql = " INSERT INTO jitendra_login (FullName,customer_company_name,email,Address,Tel,password,role) VALUES ('{$stu_name}','{$stu_comapany}', '{$stu_email}','{$stu_address}','{$stu_tel}', '{$stu_password}','{$stu_role}')";
 
  $result = mysqli_query($conn, $sql) or die("query unsuccessfull.");
  mysqli_close($conn);
}

?>