<?php /** @noinspection ALL */ ?>

<div class="container">
    <h3>Welcome to our survey service!</h3>
    <?php if (isset($_SESSION['user'])): ?>
        <h3>Proceed to the cabinet</h3>
        <div>
            <div>
                <a href="/survey/all"><button type="button">Cabinet</button></a>
            </div>
        </div>
    <?php else: ?>
        <h3>Choose an action</h3>
        <div>
            <div>
                <a href="/user/login"><button type="button">Login</button></a>
            </div>
            <div>
                <a href="/user/register"><button type="button">Register</button></a>
            </div>
        </div>
    <?php endif; ?>
</div>
