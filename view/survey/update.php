<?php /** @noinspection ALL */ ?>

<?php /** @var \Model\Question $question */ ?>
<?php /** @var \Model\Answer[] $answers */ ?>

<form action="<?= isset($question->id) ? '/survey/update/id/' . $question->id : '/survey/create' ?>" method="POST">
    <div class="container">
        <div class="header"><?= isset($question->id) ? 'Update your survey #' . $question->id : 'Create survey' ?></div>
        <div class="field-wrapper framed">
            <div class="sub-header">Question</div>
            <div>
                <label for="status">Status</label>
                <select name="status" id="status">
                <?php foreach (\Model\Question::STATUSES as $key => $status): ?>
                    <option value="<?= $key ?>" <?= (isset($question->status) && $question->status == $key) ? 'selected="selected"' : '' ?>><?= $status ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="field-wrapper">
                <label for="text">Text</label>
                <textarea class="input" name="text" id="text" required><?= $question->text ?? '' ?></textarea>
            </div>
        </div>
        <div class="field-wrapper framed">
            <div class="sub-header">Answers</div>
            <?php if (isset($answers)): ?>
                <?php foreach ($answers as $answer): ?>
                <div class="field-wrapper answer-row answer-<?= $answer->id ?>">
                    <input type="hidden" name="answer[<?= $answer->id ?>][id]" value="<?= $answer->id ?>"/>
                    <div class="field-wrapper">
                        <label for="answer[<?= $answer->id ?>][text]">Text</label>
                        <input class="input" type="text" name="answer[<?= $answer->id ?>][text]" id="answer[<?= $answer->id ?>][text]" value="<?= $answer->text ?>" required/>
                    </div>
                    <div class="field-wrapper">
                        <label for="answer[<?= $answer->id ?>][votes_number]">Votes number</label>
                        <input type="number" name="answer[<?= $answer->id ?>][votes_number]" id="answer[<?= $answer->id ?>][votes_number]" value="<?= $answer->votes_number ?>" required/>
                    </div>
                    <button type="button" class="button remove-answer-<?= $answer->id ?>" onclick="removeAnswerById('<?= $answer->id ?>')">Remove answer</button>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="add-answer-container"></div>
            <button type="button" class="button add-answer" onclick="addAnswer()">Add answer</button>
        </div>
        <a href="/survey/all" class="button">Back</a>
        <button class="button" type="submit">Save survey</button>
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

        var element = document.createElement('div');
        element.className = 'field-wrapper answer-row answer-' + answerId;
        element.innerHTML = '<input type="hidden" name="answer['+answerId+'][id]" value="'+answerId+'"/><div class="field-wrapper"><label for="answer['+answerId+'][text]">Text</label><input class="input" type="text" name="answer['+answerId+'][text]" id="answer['+answerId+'][text]" required/></div><div class="field-wrapper"><label for="answer['+answerId+'][votes_number]">Votes number</label><input type="number" name="answer['+answerId+'][votes_number]" id="answer['+answerId+'][votes_number]" required/></div><button type="button" class="button remove-answer-'+answerId+'" onclick="removeAnswerById(\''+answerId+'\')">Remove answer</button>';

        container.appendChild(element);
    }
</script>
