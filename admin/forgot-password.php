<?php
include 'class/atclass.php';
include 'mailclass/PHPMailerAutoload.php';
$page_title = "Forgot Password";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?> | <?php echo $project_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="dist/img/AdminLTELogo.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>Admin Panel</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

        <form action="#" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Enter Email" required="">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="index.php">Back to Login</a>
        </p>
        <!--      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>-->
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <button type="button" class="btn btn-success mybtn" style="display:none;">

  </button>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!--<script src="addnew/sweetalert2@9.js"></script>-->
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <?php
  if (isset($_POST["submit"])) {
    $email = mysqli_real_escape_string($connection, $_POST['email']);



    $query = mysqli_query($connection, "select * from tbl_admin where admin_email='{$email}'") or die(mysqli_error($connection));

    $count = mysqli_num_rows($query);

    if ($count > 0) {

      $row = mysqli_fetch_array($query);

      $adminemail = $row['admin_email'];

      $adminpassword = $row['admin_password'];

      $email_send = $adminemail;
      $subject = "Forgot Password";
      $body = "Your Password is $adminpassword";

      $mail = new PHPMailer;
      $mail->isSMTP();                                // Set mailer to use SMTP
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->SMTPSecure = $smtpsecure;                            // Enable TLS encryption, `ssl` also accepted
      $mail->Host = $host_email;
      $mail->Port = $port;                                    // TCP port to connect to
      $mail->Username = $email_username;                 // SMTP username
      $mail->Password = $email_password;                          // SMTP password

      $mail->addreplyto($email_username, $mail_title);
      $mail->setfrom($email_username, $mail_title);

      $mail->addaddress($email_send, $subject);
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->msgHTML($body);
      //         echo '<pre>';
      // print_r($mail);
      //                 exit;
      if (!$mail->send()) {

        $msg = "Your Mail Not Send";
        $alert = "warning";

  ?>
        <script>
          $(document).ready(function() {
            $('.mybtn').trigger('click');
            window.setTimeout(function() {
              window.location.href = "forgot-password.php";
            }, 2000);

          });
        </script>
      <?php
      } else {

        $msg = "Check Your Mail For Password";
        $alert = "success";

      ?>
        <script>
          $(document).ready(function() {
            $('.mybtn').trigger('click');
            window.setTimeout(function() {
              window.location.href = "index.php";
            }, 2000);

          });
        </script>
      <?php
      }
    } else {

      $msg = "Email Not Match With System";
      $alert = "warning";

      ?>
      <script>
        $(document).ready(function() {
          $('.mybtn').trigger('click');
          window.setTimeout(function() {
            window.location.href = "forgot-password.php";
          }, 2000);

        });
      </script>
  <?php
    }
  }
  ?>
  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $('.mybtn').click(function() {


      Toast.fire({
        type: '<?php echo $alert; ?>',

        title: '<?php echo $msg; ?>'
      })

    });
  </script>
</body>

</html>