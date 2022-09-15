<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/config.php';

/* タスク登録
---------------------------------------------*/
// 初期化
$title = '';
$errors = [];

//フォームに入力された値を受け取って、$titleに代入する
// リクエストメソッドの判定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームに入力されたデータを受け取る
    $title = filter_input(INPUT_POST, 'title');
    //バリデーション
    $errors = insert_validate($title);

    // タスク登録処理の実行
    //ここではフォームで受け取った値をtaskデータベースのtitleカラムに追加するだけで、表示はliタグのforeachでする
    if (empty($errors)) {
        insert_task($title);
    }
}

$notyet_tasks = find_task_by_done(TASK_NOTYET);
$done_tasks = find_task_by_done(TASK_DONE);
?>
<!DOCTYPE html>
<html lang="ja">

<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="wrapper">
        <header class="header-task">
            <h1><a href="index.php">My Tasks</a></h1>
        </header>
        <div class="dashboard">
            <label for="form-box" class="ellipse"></label>
            <input type="checkbox" value="" id="form-box">
            <div class="new-task task-form-group">
                <!-- エラーが発生した場合、エラーメッセージを出力 -->
                <?php include_once __DIR__ . '/_errors.php' ?>
                <form action="" method="post">
                    <input type="text" name="title" placeholder="タスクを入力してください">
                    <button type="submit" class="big-btn add-btn">
                        <span>Add New</span>
                        <i class="fa-solid big-icon fa-plus"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="notyet-task">
            <h2>未完了タスク</h2>
            <ul>
                <?php foreach ($notyet_tasks as $task) : ?>
                    <li class="one-task">
                        <a href="" class="btn check-btn done-btn"><i class="fa-solid fa-check"></i></a>
                        <p><?= h($task['title']) ?></p>
                        <div class="btn-set">
                            <a href="" class="btn edit-btn"><i class="fa-solid fa-pencil"></i></a>
                            <a href="" class="btn delete-btn"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="done-task">
            <h2>完了タスク</h2>
            <ul>
                <li class="one-task">
                    <a href="" class="btn check-btn reply-btn"><i class="fa-solid fa-reply"></i></a>
                    <p>完了テストタスク</p>
                    <div class="btn-set">
                        <a href="" class="btn edit-btn"><i class="fa-solid fa-pencil"></i></a>
                        <a href="" class="btn delete-btn"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>
