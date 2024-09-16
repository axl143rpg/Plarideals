<?php
include('../includes/config.php');

$selectQuery = "SELECT * FROM consumers ORDER BY created_at DESC";
$result = $conn->query($selectQuery);


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
   
    header("Location: index.php"); // Redirect to login or a page with access denied message
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consumers = $_POST['consumers'];
    $membershipAmount = $_POST['membershipAmount'];

    $insertQuery = "INSERT INTO consumers (type, amount) VALUES ('$consumers', $membershipAmount)";
    
    if ($conn->query($insertQuery) === TRUE) {
        $successMessage = 'Membership type added successfully!';
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}


?>



<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
<?php include('includes/header.php');?>
  <?php include('includes/navbar.php');?>

 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
  <?php include('includes/pagetitle.php');?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        
        <div class="col-12">

        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Consumers DataTable</h3>
    </div>
    <!-- Visit codeastro.com for more projects -->
    <!-- /.card-header -->
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>address</th>
                <th>contact_number</th>
                <th>status</th>
                <th>created_at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                
                $currentDate = time();
              


                $consumersId = $row['id'];
                $consumersQuery = "SELECT status FROM consumers WHERE id = $consumersId";
                $consumersResult = $conn->query($consumersQuery);
                $consumersRow = $consumersResult->fetch_assoc();
                

                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['contact_number']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "<td>";

              

                echo "
                    <a href='edit_member.php?id={$row['id']}' class='btn btn-primary'><i class='fas fa-edit'></i></a>
                    <button class='btn btn-danger' onclick='deleteUser({$row['id']})'><i class='fas fa-trash'></i></button>
                </td>";
                echo "</tr>";

                $counter++;
            }
            ?>
        </tbody>
    </table>
</div>

    <!-- /.card-body -->
</div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->

        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Visit codeastro.com for more projects -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include('includes/footer.php'); ?>
</div>
<!-- ./wrapper -->

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
    function deleteUser(id) {
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = 'delete_members.php?id=' + id;
        }
    }
</script>

</body>
</html>