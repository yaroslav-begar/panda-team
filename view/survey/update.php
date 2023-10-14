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
                        <option value="<?= $key ?>" <?= (isset($question->status) && $question->status == $key) ? 'selected="selected"' : '' ?>><?= $status ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="text">Text</label>
                    <textarea name="text" required><?= $question->text ?? '' ?></textarea>
                </div>
            </div>
            <div class="answers">
                <h3>Answers</h3>
                <div>
                    <?php if (isset($answers)): ?>
                        <?php foreach ($answers as $answer): ?>
                        <div class="answer-row answer-<?= $answer->id ?>">
                            <input type="hidden" name="answer[<?= $answer->id ?>][id]" value="<?= $answer->id ?>"/>
                            <div>
                                <label for="answer[<?= $answer->id ?>][text]">Text</label>
                                <input type="text" name="answer[<?= $answer->id ?>][text]" value="<?= $answer->text ?>" required/>
                            </div>
                            <div>
                                <label for="answer[<?= $answer->id ?>][votes_number]" >Votes number</label>
                                <input type="number" name="answer[<?= $answer->id ?>][votes_number]" value="<?= $answer->votes_number ?>" required/>
                            </div>
                            <div>
                                <button type="button" class="remove-answer-<?= $answer->id ?>" onclick="removeAnswerById('<?= $answer->id ?>')">Remove answer</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="add-answer-container"></div>
                    <div>
                        <button type="button" class="add-answer" onclick="addAnswer()">Add answer</button>
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
<script>
    function removeAnswerById(id) {
        document.getElementsByClassName('answer-' + id)[0].remove();
    }
    function addAnswer() {
        var container = document.getElementsByClassName('add-answer-container')[0];

        var answerId = 1;
        var answerIds = [];
        var elements = document.getElementsByClassName('answer-row');
        Array.from(elements).forEach(
            function(element, index, array) {
                answerIds.push(element.className.split('-')[2]);
            }
        );
        if (answerIds.length > 0) {
            answerId = Math.max.apply(Math, answerIds) + 1;
        }

        var html = '<div class="answer-row answer-'+answerId+'"><input type="hidden" name="answer['+answerId+'][id]" value="'+answerId+'"/><div><label for="answer['+answerId+'][text]">Text</label><input type="text" name="answer['+answerId+'][text]" required/></div><div><label for="answer['+answerId+'][votes_number]">Votes number</label><input type="number" name="answer['+answerId+'][votes_number]" required/></div><div><button type="button" class="remove-answer-'+answerId+'>" onclick="removeAnswerById(\''+answerId+'\')">Remove answer</button><div></div>';
        container.innerHTML += html;
    }
</script>
