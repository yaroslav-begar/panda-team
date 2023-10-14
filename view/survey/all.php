<?php /** @noinspection ALL */ ?>

<?php /** @var \Model\Question[] $questions */ ?>

<div class="container">
    <div class="header">Your survey list</div>
    <a href="/survey/create" class="button">Create survey</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Text</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($questions as $question): ?>
        <tr>
            <td><?= $question->id ?></td>
            <td><?= $question->user_id ?></td>
            <td><?= $question->text ?></td>
            <td><?= \Model\Question::STATUSES[$question->status] ?></td>
            <td><?= $question->created_at ?></td>
            <td>
                <a href="/survey/view/id/<?= $question->id ?>" class="button info">View</a>
                <a href="/survey/update/id/<?= $question->id ?>" class="button success">Edit</a>
                <a href="/survey/delete/id/<?= $question->id ?>" class="button danger">Remove</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="/user/logout" class="button">Logout</a>
</div>
