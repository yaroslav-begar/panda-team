<?php /** @noinspection ALL */ ?>

<?php /** @var \Model\Question $question */ ?>
<?php /** @var \Model\Answer[] $answers */ ?>

<div class="container">
    <h3>Your survey #<?= $question->id ?></h3>
    <div class="question">
        <h3>Question</h3>
        <div>
            <table>
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
    </div>
    <h3>Your answers</h3>
    <div class="answers">
        <table>
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
</div>
