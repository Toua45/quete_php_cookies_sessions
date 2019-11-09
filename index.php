<?php
if (isset($_POST['submit'])) {
    if (isset($_COOKIE['cart'])) $cart = explode("/", $_COOKIE['cart']);
    $cart[] = $_POST['submit'];
    setcookie('cart', implode('/', $cart), time() + (86400 * 30));
    header('Location: index.php');
}
require 'inc/data/products.php';
require 'inc/head.php';

?>
<?php
if (!isset($_SESSION['userName'])) {
    ?>
    <div class="container-fluid text-center">
        <h2>Please login if you want to add items in your cart</h2>
    </div>
    <?php
}
?>
    <section class="cookies container-fluid">
        <div class="row">
            <?php foreach ($catalog as $id => $cookie) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <figure class="thumbnail text-center">
                        <img src="assets/img/product-<?= $id; ?>.jpg" alt="<?= $cookie['name']; ?>"
                             class="img-responsive">
                        <figcaption class="caption">
                            <h3><?= $cookie['name']; ?></h3>
                            <p><?= $cookie['description']; ?></p>
                            <form class="form-inline" method="post">
                                <button <?= (isset($_SESSION['userName'])) ? '' : 'style="display:none;"' ?>
                                        type="submit" class="btn btn-primary" name="submit" value="<?= $id; ?>" <?php
                                if (isset($_COOKIE['cart']) && in_array($id, explode('/', $_COOKIE['cart']))){
                                    echo 'disabled>Already in the cart';
                                }else{
                                ?>>
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add to cart<?php
                                    }
                                    ?></button>
                            </form>
                        </figcaption>
                    </figure>
                </div>

            <?php } ?>
        </div>
    </section>
<?php
require 'inc/foot.php';
