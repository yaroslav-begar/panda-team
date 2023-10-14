<?php /** @noinspection ALL */ ?>

<form action="/user/register" method="POST">
    <div class="container">
        <div class="header">Register</div>
        <div class="field-wrapper">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="input"/>
        </div>
        <div class="field-wrapper">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="input"/>
        </div>
        <button  class="button"  type="submit">Register</button>
    </div>
</form>
