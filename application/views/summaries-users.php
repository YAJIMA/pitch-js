<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <p>&nbsp;</p>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/problems'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/problems'); ?>">問題設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/summaries'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/summaries'); ?>">集計設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'settings/commons'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/commons'); ?>">その他設定</a>
                </li>
            </ul>
        </nav>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
            <h1>生徒一覧</h1>

            <section class="row text-center placeholders">
            </section>

            <div>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>名前</th>
                        <th>ディレクトリパス</th>
                        <th>ユーザーID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo (empty($user['realname'])) ? '（未設定）' : $user['realname']; ?></td>
                        <td><?php echo $user['directory']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
