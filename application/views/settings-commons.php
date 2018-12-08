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
                    <a class="nav-link <?php if (uri_string() == 'settings/users'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/users'); ?>">生徒設定</a>
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
            <h1>その他の設定</h1>

            <?php echo form_open('settings/commons'); ?>
            <div class="form-group">
                <label for="admin_email">管理者メールアドレス</label>
                <input type="text" name="admin_email" id="admin_email" class="form-control" value="<?php echo (isset($settings['admin_email'])) ? $settings['admin_email'] : '';?>">
                <span class="help-block">複数アドレスに送信する場合は、カンマ( , )で区切って入力</span>
            </div>
            <div class="form-group">
                <label for="result_subject">テスト結果メール件名</label>
                <input type="text" name="result_subject" id="result_subject" class="form-control" value="<?php echo (isset($settings['result_subject'])) ? $settings['result_subject'] : '音感テストの結果お知らせメール';?>">
            </div>
            <div class="form-group">
                <label for="result_body">テスト結果メール本文</label>
                <textarea name="result_body" id="result_body" rows="8" class="form-control" ><?php echo (isset($settings['result_body'])) ? $settings['result_body'] : '';?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
            <?php echo form_close(); ?>
        </main>
    </div>
</div>
