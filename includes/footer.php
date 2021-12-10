<!-- <section class="register-popup">
    <form action="">

    </form>
</section> -->
<?php //include_once "login.php"; 
?>

<?php //include_once "register.php"; 
?>


</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="<?= get_url("img/footer-logo.png"); ?>" alt="">
                <blockquote>
                    “Kind words can be short and easy to speak, but their echoes are truly endless.”
                    <span>Mother Teresa</span>
                </blockquote>
                <a class="mail-link" href="mailto:letterareaworld@gmail.com">letterareaworld@gmail.com</a>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-5 navigation-block">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                        <a href="<?= get_url("about"); ?>">About</a>
                    </div>
                    <div class="col-lg-5">
                        <a href="<?= get_url("postcards"); ?>">Postcards</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                        <a href="<?= get_url("services"); ?>">Services</a>
                    </div>
                    <div class="col-lg-5">
                        <a href="<?= get_url("explore"); ?>">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>

<script src="<?= get_url('js/main.js') ?>"></script>

</body>

</html>