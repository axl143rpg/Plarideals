<?php
include('includes/config.php');

$selectQuery = "SELECT * FROM consumers";
$result = $conn->query($selectQuery);

if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}


?>

<?php include('includes/header.php'); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include('includes/nav.php'); ?>

    <?php include('includes/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <?php include('includes/pagetitle.php'); ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <!-- Visit codeastro.com for more projects -->
          <div class="row">

            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">consumers DataTable</h3>
                </div>
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
                        <th>account_number</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $counter = 1;
                      while ($row = $result->fetch_assoc()) {
                        echo "<td>{$row['id']}";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['address']}</td>";
                        echo "<td>{$row['contact_number']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "<td>{$row['account_number']}</td>";
                        echo "<td>{$row['created_at']}</td>";
                        echo "<td>{$row['updated_at']}</td>";
                        echo "<td>
                           <a href='renew.php?id={$row['id']}' class='btn btn-success'>Renew</a>
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
              <!-- Visit codeastro.com for more projects -->
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

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
   
    </footer>
  </div>
  <!-- ./wrapper -->

  <?php include('includes/footer.php'); ?>
  <script>
    $(function() {
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

</body>

</html>