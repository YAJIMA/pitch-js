<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">管理</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown <?php if (uri_string() == 'settings'): ?>active<?php endif; ?>">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">設定 <span class="sr-only">(今ｺｺ)</span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item <?php if (uri_string() == 'settings/problems'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/problems'); ?>">問題設定</a>
                        <a class="dropdown-item <?php if (uri_string() == 'settings/users'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/users'); ?>">生徒設定</a>
                        <a class="dropdown-item <?php if (uri_string() == 'settings/summaries'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/summaries'); ?>">集計設定</a>
                        <a class="dropdown-item <?php if (uri_string() == 'settings/commons'): ?>active<?php endif; ?>" href="<?php echo base_url('settings/commons'); ?>">その他設定</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('summaries'); ?>">集計</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

