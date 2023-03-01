
<?php
//Update portion
if(isset($_POST['checking_update_btn'])){
    $id=$_POST['note_id'];
    echo $return=$id;
    $title=$_POST['title_edit'];
    $description=$_POST['description_edit'];
  
    $updateq="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`id` = '$id';";
    $res_arr=[];
  
    $uquery="SELECT * FROM `notes` WHERE id='$id";
    $uquery_run=mysqli_query($con,$uquery);
    if (mysqli_num_rows($uquery_run)>0)
    {
      foreach($uquery_run as $row)
      {
        array_push($result_arr,$row);
        header('content-type: application/json');
        echo  json_encode($result_arr);
      }
    }
    else
    {
      echo $return="<h5>No data found</h5>";
    }
  }
 ?>