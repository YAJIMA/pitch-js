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
            <h1>集計設定</h1>

            <form method="post" action="">
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="form-control">
                </div>
            </form>
        </main>
    </div>
</div>
