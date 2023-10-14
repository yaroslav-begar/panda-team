<?php /** @noinspection ALL */ ?>

<?php /** @var \Model\Question $question */ ?>
<?php /** @var \Model\Answer[] $answers */ ?>

<form action="<?= isset($question->id) ? '/survey/update/id/' . $question->id : '/survey/create' ?>" method="POST">
    <div class="container">
        <h3><?= isset($question->id) ? 'Update your survey #' . $question->id : 'Create survey' ?></h3>
        <div>
            <div class="question">
                <h3>Question</h3>
                <div>
                    <label for="status">Status</label>
                    <select name="status">
                    <?php foreach (\Model\Question::STATUSES as $key => $status): ?>
                        <option value="<?= $key ?>" <?php if (isset($question->status) && $question->status == $key) echo "selected" ?>><?= $status ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="text">Text</label>
                    <textarea name="text"><?= $question->text ?? '' ?></textarea>
                </div>
            </div>
            <div class="answers">
                <h3>Answers</h3>
                <div>
                    <?php if (isset($answers)): ?>
                        <?php foreach ($answers as $answer): ?>
                        <div class="answer">
                            <input type="hidden" name="answer-<?= $answer->id ?>" value="<?= $answer->id ?>">
                            <div>
                                <label for="answer-<?= $answer->id ?>-text">Text</label>
                                <input type="text" name="answer-<?= $answer->id ?>-text" value='<?= $answer->text ?>'/>
                            </div>
                            <div>
                                <label for="answer-<?= $answer->id ?>-votes-number" >Votes number</label>
                                <input type="number" name="answer-<?= $answer->id ?>-votes-number" value="<?= $answer->votes_number ?>"/>
                            </div>
                            <div>
                                <button type="button">Remove answer</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div>
                        <button type="button">Add answer</button>
                    </div>
                </div>
            </div>
            <div>
                <a href="/survey/all"><button type="button">Back</button></a>
            </div>
            <div>
                <button type="submit">Save survey</button>
            </div>
        </div>
    </div>
</form>
