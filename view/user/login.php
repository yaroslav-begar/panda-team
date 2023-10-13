<?php /** @noinspection ALL */ ?>

<form action="/user/login" method="POST">
    <div class="container">
        <h3>Login</h3>
        <div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email"/>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password"/>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </div>
    </div>
</form>
