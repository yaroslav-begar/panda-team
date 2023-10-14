<?php /** @noinspection ALL */ ?>

<div class="container">
    <div class="header">Welcome to our survey service!</div>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="sub-header">Proceed to the cabinet</div>
        <a href="/survey/all" class="button">Cabinet</a>
    <?php else: ?>
        <div class="sub-header">Choose an action</div>
        <div>
            <a href="/user/login" class="button">Login</a>
            <a href="/user/register" class="button register">Register</a>
        </div>
    <?php endif; ?>
</div>
