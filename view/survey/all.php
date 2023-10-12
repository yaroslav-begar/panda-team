<?php /** @noinspection ALL */ ?>

<?php /** @var \Model\Question $question */ ?>
<?php foreach ($items as $question): ?>
    <div><?= $question->id ?></div>
    <div><?= $question->user_id ?></div>
    <div><?= $question->text ?></div>
    <div><?= $question->status ?></div>
    <div><?= $question->created_at ?></div>
<?php endforeach; ?>
