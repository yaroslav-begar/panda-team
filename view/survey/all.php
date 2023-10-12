<?php /** @noinspection ALL */ ?>

<div class="container">
    <h3">Your survey list</h3>
    <div>
        <div>
            <a href="/survey/update"><button type="button">Create survey</button></a>
        </div>
    </div>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Text</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            <?php /** @var \Model\Question $question */ ?>
            <?php foreach ($items as $question): ?>
                <tr>
                    <td><?= $question->id ?></td>
                    <td><?= $question->user_id ?></td>
                    <td><?= $question->text ?></td>
                    <td><?= \Model\Question::STATUSES[$question->status] ?></td>
                    <td><?= $question->created_at ?></td>
                    <td>
                        <a href="/survey/view?id=<?= $question->id ?>"><button type="button">View</button></a>
                        <a href="/survey/update?id=<?= $question->id ?>"><button type="button">Edit</button></a>
                        <a href="/survey/remove?id=<?= $question->id ?>"><button type="button">Remove</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
