 <?php
  
  require('../extra/func.php');
  require('../extra/connect.php');
  adminLogin();

  if(isset($_POST['add_rooms'])){
    
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    $frm_data = filteration($_POST);
   
    $flag=0;

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $values = [$frm_data['name'],$frm_data['area'],$frm_data['price'],$frm_data['quantity'],$frm_data['adult'],$frm_data['children'],$frm_data['desc']];
    
    if(insert($q1,$values,'siiiiis')){
      $flag=1;
    }

    $room_ID = mysqli_insert_id($db);
    
    $q2 = "INSERT INTO `room_facilities`(`room_ID`, `fac_ID`) VALUES (?,?)";

    if($stmt = mysqli_prepare($db,$q2)){
      foreach($facilities as $f){
        mysqli_stmt_bind_param($stmt,'ii',$room_ID,$f);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
    }
    else{
      $flag=0;
      die('Query cannot be prepared - Insert');
    }

    $q3 = "INSERT INTO `room_features`(`room_ID`, `features_ID`) VALUES (?,?)";

    if($stmt = mysqli_prepare($db,$q3)){
      foreach($features as $f){
        mysqli_stmt_bind_param($stmt,'ii',$room_ID,$f);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);
    }
    else{
      $flag=0;
      die('Query cannot be prepared - Insert');
    }

    if($flag){
      echo 1;
    }
    else{
      echo 0;
    }

  }

  if(isset($_POST['get_rooms'])){
    $res = selectAll('rooms'); //database table selected
    $no=1;

    $data = "";
    
    while($row = mysqli_fetch_assoc($res)){
      if($row['status']==1){
        $status = "<button onclick='toggle_status($row[R_ID],0)' class='btn btn-dark btn-sm shadow-none'>ACTIVE</button>";
      }
      else{
        $status = "<button onclick='toggle_status($row[R_ID],1)' class='btn btn-danger btn-sm shadow-none'>INACTIVE</button>";
      }
      
      $data.="
        <tr class='align-middle'>
          <td>$no</td>
          <td>$row[name]</td>
          <td>$row[area] sq.ft.</td>
          <td>Tk. $row[price]</td>
          <td>$row[quantity]</td>
          <td>
            <span class='badge rounded-pill bg-light text-dark'>
              Adult: $row[adult]
            </span><br>
            <span class='badge rounded-pill bg-light text-dark'>
              Children: $row[children]
            </span><br>
          </td>
          <td>$status</td>
          <td>buttons</td>
        </tr>
      ";
      $no++;
    }
    echo $data;
  }

  if(isset($_POST['toggle_status'])){
    
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `R_ID`=?";
    $v =  [$frm_data['value'],$frm_data['toggle_status']];

    if(update($q,$v,'ii')){
      echo 1;
    }
    else{
      echo 0;
    }
   
   

  }

  



  // if(isset($_POST['remove_features'])){
  //   $frm_data = filteration($_POST);
  //   $values = [$frm_data['remove_features']];

  //   $q = "DELETE FROM `features` WHERE `feature_ID`=?";
  //   $res = delete($q, $values,'i');
  //   echo $res;
   
  // }


  // // Facilities section fetch

  // if(isset($_POST['add_facilities'])){
    
  //   $frm_data = filteration($_POST);

  //   $img_res = uploadImage($_FILES['icon'],FACILITIES_FOLDER); //rname created in func.php

  //   if($img_res == 'inv_img'){
  //     echo $img_res;
  //   }
  //   else if($img_res == 'upd_failed'){
  //     echo $img_res;
  //   }
  //   else{
  //     $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
  //     $values = [$img_res,$frm_data['name'],$frm_data['description']];
  //     $res = insert($q,$values,'sss');
  //     echo $res;
  //   }
  // }

  // if(isset($_POST['get_facilities'])){
  //   $res = selectAll('facilities'); //database table selected
  //   $no=1;
  //   $path = FACILITIES_IMG_PATH;

  //   while($row = mysqli_fetch_assoc($res)){
     
  //     echo <<<data
  //      <tr class='align-middle'>
  //       <td>$no</td>
  //       <td><img src="$path$row[icon]" width="30px"></td>
  //       <td>$row[name]</td>
  //       <td>$row[description]</td>
  //       <td>
  //         <button type="button" onclick="remove_facilities($row[facilities_ID])" class="btn btn-danger btn-small shadow-none fs-6">
  //         <i class="bi bi-trash3-fill"></i> Delete
  //         </button>
  //       </td>   
  //      </tr>
  //     data;
  //     $no++;
  //   }
  // }

  // if(isset($_POST['remove_facilities'])){
  //   $frm_data = filteration($_POST);
  //   $values = [$frm_data['remove_facilities']];

  //   $pre_q = "SELECT * FROM `facilities` WHERE `facilities_ID`=?"; //pre query
  //   $res = select($pre_q,$values,'i');
  //   $img = mysqli_fetch_assoc($res);

  //   if(deleteImage($img['icon'], FACILITIES_FOLDER)){
  //     $q = "DELETE FROM `facilities` WHERE `facilities_ID`=?";
  //     $res = delete($q, $values,'i');
  //     echo $res;
  //   }
  //   else{
  //     echo 0;
  //   }
  // }

?>