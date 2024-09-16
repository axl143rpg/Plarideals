<?php
include('../includes/config.php');


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {

  header("Location: ./index.php"); // Redirect to login or a page with access denied message
  exit();
}
$selectQuery = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($selectQuery);


if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $users = $_POST['users'];
    $membershipAmount = $_POST['membershipAmount'];

    $insertQuery = "INSERT INTO users (type, amount) VALUES ('$users', $membershipAmount)";
    
    if ($conn->query($insertQuery) === TRUE) {
        $successMessage = 'Membership type added successfully!';
        // header("Location: dashboard.php");
        // exit();
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}

$current_page = basename($_SERVER['PHP_SELF']);

$fetchSystemNameQuery = "SELECT system_name FROM settings WHERE id = 1";
$fetchSystemNameResult = $conn->query($fetchSystemNameQuery);

$systemName = ($fetchSystemNameResult->num_rows > 0) ? $fetchSystemNameResult->fetch_assoc()['system_name'] : 'Plarideals';


?>
<?php include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        
        <div class="col-12">

        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Users DataTable</h3>
    </div>
    <!-- Visit codeastro.com for more projects -->
    <!-- /.card-header -->
    <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>username</th>
                <th>role</th>
                <th>created</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                
                $currentDate = time();
              


                $usersId = $row['id'];
                $usersQuery = "SELECT role FROM users WHERE id = $usersId";
                $usersResult = $conn->query($usersQuery);
                $usersRow = $usersResult->fetch_assoc();
                

                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['role']}</td>";
                echo "<td>{$row['created_at']}</td>";
                echo "<td>";

                if (!empty($row['expiry_date'])) {
                    echo "<a href='userProfile.php?id={$row['id']}' class='btn btn-info'><i class='fas fa-id-card'></i></a>";
                }

                echo "
                    <a href='edit_user.php?id={$row['id']}' class='btn btn-primary'><i class='fas fa-edit'></i></a>
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

  <!-- Content Row -->


  <?php
  
  include('includes/scripts.php');
  include('includes/footer.php');
  ?>
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

</div>