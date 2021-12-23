<?php
include_once "includes/header.php";
?>

<div class="container about-page">
    <div class="row">
        <div class="col-lg-5">
            <h3 class="mb-4">What is Letterarea?</h3>
            <p>The goal of this project is to allow anyone to send and receive postcards and emails from all over the world!</p>
            <p>The idea is simple: for each postcard you send, you will receive one back from a random postcrosser from somewhere in the world.</p>
        </div>
        <div class="col-lg-5 ml-auto">
            <h3 class="mb-4">Why?</h3>
            <p>Simply because, like its founder, there are lots of people who like to receive real mail.</p>
            <p>Receiving postcards from different places in the world (many of which you probably have never heard of!) can turn your mailbox into a box of surprises — and who wouldn't like that?</p>
        </div>
    </div>
    <h3 class="mt-4 mb-4 ml-2 text-center">Send...</h3>
    <h3 class="text-center">...and receive!</h3>
    <img class="mx-auto d-block about-image" src="<?= get_url("img/about.png"); ?>" alt="people with letter">
    <div class="row first-row-about">
        <div class="col-lg-6">
            <h3><span class="number">1</span>Write a postcard</h3>
            <p>The first step is to request to send a postcard — we'll give you the address of a random member and a Postcard ID. Pick a postcard, write a friendly message, along with its Postcard ID and the address given. Don't forget the stamps!</p>
        </div>
        <div class="col-lg-5 ml-auto">
            <h3><span class="number">2</span>Post it</h3>
            <p>Now all you need to do is mail the postcard on your nearest postbox or post office.<br>
                When your postcard arrives, its recipient will register it using its Postcard ID. This will make you eligible to receive a postcard from another member — and where your postcard will come from is a surprise!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mt-5">
            <h3 clas="mb-4 mt-5"><span class="number">3</span>Hurray! You've got mail!</h3>
            <p>One day you'll check your mailbox and a postcard from someone far away will be waiting for you!</p>
        </div>
        <div class="col-lg-5 mt-5 ml-auto">
            <h3 clas="mb-4 mt-5"><span class="number">4</span>Register the postcard</h3>
            <p>Now it's your turn to register the postcard using its Postcard ID. That's it!<br>
                Oh, and you don't need to wait to send more — you can have several postcards traveling at the same time. The more you send, the more you will receive!</p>
        </div>
    </div>

</div>

<?php
include_once "includes/footer.php";
