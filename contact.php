<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>聯絡我們Contact us</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <!-- header -->
  <div class="header"></div>
  <!-- header end -->

  <!-- Contact Start -->
  <div class="container-fluid pt-5">
    <div class="text-center mb-4">
      <h2 class="section-title px-5"><span class="px-2">聯絡我們Contact us</span></h2>
    </div>
    <div class="row px-xl-5">
      <div class="col-lg-7 mb-5">
        <div class="contact-form">
          <div id="success"></div>
          <form name="sentMessage" id="contactForm" action="contact.php" method="POST">
            <div class="control-group">
              <input type="text" class="form-control" id="name" name="name" placeholder="您的姓名" required="required" data-validation-required-message="請輸入您的姓名" />
              <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="您的Email" required="required" data-validation-required-message="請輸入您的email" />
              <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
              <input type="text" class="form-control" id="subject" name="subject" placeholder="主旨" required="required" data-validation-required-message="請輸入主旨" />
              <p class="help-block text-danger"></p>
            </div>
            <div class="control-group">
              <textarea class="form-control" rows="6" id="message" name="message" placeholder="內容" required="required" data-validation-required-message="請輸入內容"></textarea>
              <p class="help-block text-danger"></p>
            </div>
            <div>
              <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">送出</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-5 mb-5">
        <h5 class="font-weight-semi-bold mb-3">聯絡我們 Contact us</h5>
        <p>如果您有任何進一步的需求或疑問，請隨時向我們提出。我們的團隊將繼續努力提供優質的服務和產品，希望能為您提供更多讓人讚賞的衣物選擇。謝謝您的支持，期待再次為您服務！</p>
        <div class="d-flex flex-column mb-3">
          <h5 class="font-weight-semi-bold mb-3">總店</h5>
          <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>500 彰化縣彰化市 進德路1號</p>
          <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>ncue@gmail.com</p>
          <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>04 723 2105</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Contact End -->

  <?php
  if (isset($_POST['name'])) {
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $m_subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));

    $to = "s1154039@mail.ncue.edu.tw"; // Change this email to your //
    $subject = "$m_subject:  $name";
    $body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
    $header = "From: $email";
    $header .= "Reply-To: $email";

    if (!mail($to, $subject, $body, $header))
      echo '<div id="success"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>您的訊息已成功送出 </strong></div></div>';
  }
  ?>

  <!-- Footer Start -->
  <div class="footer"></div>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>

  <!-- Contact Javascript File -->
  <script src="mail/jqBootstrapValidation.min.js"></script>
  <script src="mail/contact.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>

  <!-- header, footer import -->
  <script src="js/header_footer_import.js"></script>
</body>

</html>