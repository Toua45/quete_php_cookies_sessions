<?php
require 'inc/data/products.php';
require 'inc/head.php';

if (!isset($_SESSION['userName'])) {
    header('Location: index.php');
}

if (isset($_POST['submit'])) {
    $cart = explode('/', $_COOKIE['cart']);
    foreach ($cart as $key => $article) {
        if ($article == $_POST['submit']) {
            unset($cart[$key]);
            setcookie('cart', implode('/', $cart), time() + (86400 * 30));
        }
    }
    header('Location: cart.php');
}


?>
<section class="cookies container-fluid">
    <div class="row">
        <?php foreach ($catalog as $id => $cookie) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3"><?php
                if (isset($_COOKIE['cart']) && in_array($id, explode('/', $_COOKIE['cart']))) {
                    ?>
                    <figure class="thumbnail text-center">
                        <img src="assets/img/product-<?= $id; ?>.jpg" alt="<?= $cookie['name']; ?>"
                             class="img-responsive">
                        <figcaption class="caption">
                            <h3><?= $cookie['name']; ?></h3>
                            <p><?= $cookie['description']; ?></p>
                            <form class="form-inline" method="post">
                                <button type="submit" class="btn btn-danger" name="submit" value="<?= $id; ?>">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove from cart
                                </button>
                            </form>
                        </figcaption>
                    </figure>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <a href="/"><h3>Back to home</h3></a>
</section>
<?php require 'inc/foot.php'; ?>
