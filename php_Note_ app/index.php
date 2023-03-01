<?php
// INSERT INTO `notes` (`id`, `title`, `description`, `tm-stmp`) VALUES (NULL, 'First Note', 'hey there i am making a note taking app!!', current_timestamp());

// UPDATE `notes` SET `title` = 'After Success!', `description` = 'Now I am successful about making post request!' WHERE `notes`.`id` = 9;

// use LDAP\Result;

$insert = false;
$update = false;
$delete = false;
///////////////////
$sname = "localhost";
$uname = "root";
$psrd = "";

$db_name = "my_db";

$con = mysqli_connect($sname, $uname, $psrd, $db_name);

if (!$con) {
  die("Sorry connection failed :" . mysqli_connect_error());
} else {
  // echo"Connection eshtablished!!";
}

//////delete
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM notes WHERE `notes`.`id` = $id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    $delete = true;
  }
}


// echo $_SERVER["REQUEST_METHOD"];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['sno_edit'])) {
    //Update Record
    $id = $_POST["sno_edit"];
    $title = $_POST["title_edit"];
    $description = $_POST["description_edit"];

    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `id` = '$id';";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $update = true;
    }
  } else {
    $title = $_POST["title"];
    $description = $_POST["description"];

    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title','$description')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      $insert = true;
      // echo "Record has been successfully inserted";

    } else {
      echo "Error!!" . mysqli_error($con);
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Note</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src=" https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://github.jspm.io/jmcriffey/bower-traceur-runtime@0.0.87/traceur-runtime.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
  </script>

</head>

<body>

  <!-- Edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
Edit Modal
</button> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Modify Note</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php" method="post">
          <div class="modal-body">
            <!-- /php Crud app/ -->
            <input type="hidden" name="sno_edit" id="sno_edit">

            <div class="mb-3">
              <label for="title" class="form-label">Modify Title</label>
              <input type="text" class="form-control" id="title_edit" name="title_edit">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">Modify Description</label>
              <textarea id="description_edit" name="description_edit" class="form-control" id="floatingTextarea"></textarea>
            </div>
            <!-- <button type="submit" class="sno_edit btn btn-primary">Add Note</button> -->
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="Submit" id="update-record" name="update-record" class="sno_edit btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
      </form>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="#">My-Note</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white" href="#">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item text-white" href="#">Action</a></li>
              <li><a class="dropdown-item text-white" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-white" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" style="color: rgb(147, 155, 155);">Disabled</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>RECORDED!</strong> Your Note has been recordeed successfully!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if ($update) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>UPDATED!</strong> Your Note has been updated successfully!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if ($delete) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>DELETED!</strong> Your Note has been deleted successfully!!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>
  <!-- echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>Holy guacamole!</strong> You should check in on some of those fields below.
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>"; -->

  <div class="container my-4">
    <h2>Add Note </h2>
    <form action="index.php" method="post">
      <!-- /php Crud app/ -->
      <div class="mb-3">
        <label for="title" class="form-label">Meta-Note</label>
        <input type="text" class="form-control" id="title" placeholder="Give a title for your Note" name="title">
        <div id="emailHelp" class="form-text">Helps You identifying Your requirement easily</div>
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">Description</label>
        <textarea id="description" name="description" class="form-control" placeholder="Leave Description Here!!" id="floatingTextarea"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>

      <tbody>
        <?php

        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($con, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
        <th scope='row'class='note_id'> " . $sno . "</th>
        <td>$row[title]</td>
        <td>$row[description]</td>
        <td><button class='edit btn btn-sm btn-primary' type='button' id=" . $row['id'] . ">Edit</button>  <button class='delete btn btn-sm btn-primary' type='button' id=d" . $row['id'] . ">Delete</button></td>

        
      </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>



  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit")
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        // console.log(title, description)
        title_edit.value = title;
        description_edit.value = description;
        sno_edit.value = e.target.id;
        // console.log(sno_edit); 
        $('#editModal').modal('toggle');
      })

    })

    //delete

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit")
        id = e.target.id.substr(1, );

        if (confirm("Are you sure?!")) {
          console.log("yes!")
          window.location = `index.php?delete=${id}`;
        } else {
          console.log("No!!")
        }
      })

    })
  </script>
</body>

</html>