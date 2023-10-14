<?php /** @noinspection ALL */ ?>

<div class="container">
    <div>
        <span class="message"><?= 'An error has occurred: "' . $error . '".' ?>
            <br/> Please contact the administrator
        </span>
    </div>
    <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="button">Back</a>
</div>
