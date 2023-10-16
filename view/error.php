<?php /** @noinspection ALL */ ?>

<div class="container">
    <div>
        <span class="message"><?= 'An error has occurred: "' . $error . '".' ?>
            <br/> Please contact the administrator
        </span>
    </div>
    <?php if (isset($_SERVER['HTTP_REFERER'])): ?>
        <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="button">Back</a>
    <?php endif; ?>
</div>
