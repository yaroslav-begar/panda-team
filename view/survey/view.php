<?php /** @noinspection ALL */ ?>

<?php /** @var \Model\Question $question */ ?>
<?php /** @var \Model\Answer[] $answers */ ?>

<div class="container">
    <div class="header">Your survey #<?= $question->id ?></div>
    <div class="question">
        <div class="sub-header">Question</div>
        <table class="table">
            <tr>
                <th>Text</th>
                <th>Status</th>
            </tr>
            <tr>
                <td><?= $question->text ?></td>
                <td><?= \Model\Question::STATUSES[$question->status] ?></td>
            </tr>
        </table>
    </div>
    <?php if (!empty($answers)): ?>
    <div class="answers">
        <div class="sub-header">Answers</div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Text</th>
                <th>Votes Number</th>
            </tr>
            <?php foreach ($answers as $answer): ?>
            <tr>
                <td><?= $answer->id ?></td>
                <td><?= $answer->text ?></td>
                <td><?= $answer->votes_number ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    <a href="/survey/all" class="button">Back</a>
</div>
