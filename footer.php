<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">G</span>Monkey</h1>
                </a>
                <p>如果您有任何進一步的需求或疑問，請隨時向我們提出。我們的團隊將繼續努力提供優質的服務和產品，希望能為您提供更多讓人讚賞的衣物選擇。謝謝您的支持，期待再次為您服務！</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>500 彰化縣彰化市 進德路1號</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>ncue@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i> 04 723 2105</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">快速連結</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <?php
                            echo'
                            <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>首頁</a>
                            <a class="text-dark mb-2" href="all.php"><i class="fa fa-angle-right mr-2"></i>開始購物</a>
                            <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>購物車</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("上衣") . '"><i class="fa fa-angle-right mr-2"></i>上衣 TOPS</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("長褲") . '"><i class="fa fa-angle-right mr-2"></i>長褲 PANTS</a>
                            ';
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">快速連結</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <?php
                            echo '
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("短褲") . '"><i class="fa fa-angle-right mr-2"></i>短褲 SHORTS</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("裙裝") . '"><i class="fa fa-angle-right mr-2"></i>裙裝 SKIRTS</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("連身") . '"><i class="fa fa-angle-right mr-2"></i>連身 JUMPSUITS</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("外套") . '"><i class="fa fa-angle-right mr-2"></i>外套 JACKETS</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("配飾") . '"><i class="fa fa-angle-right mr-2"></i>配飾 ACCESSORIES</a>
                            <a class="text-dark mb-2" href="all.php?category_choice=' . urlencode("鞋子") . '"><i class="fa fa-angle-right mr-2"></i>鞋子 SHOES</a>
                            ';
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <!-- <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                            </div>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Gummy Monkey Clothing</a>
                    <a class="text-dark font-weight-semi-bold" href="https://www.free-css.com/free-css-templates/page277/eshopper" target="_blank">.Template Source</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>