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
            <h1>問題設定</h1>
            <p>問題の出題方法を設定します。</p>
            <p>設定したい生徒名を見つけたら、設定ボタンを押して、問題を設定してください。</p>
            <p>生徒名がわかる場合は、<kbd>Ctrl</kbd>+<kbd>F</kbd>を押して検索してください。<a href="#" class="text-muted" data-toggle="modal" data-target="#hint01">？</a></p>
            <!-- Modal -->
            <div class="modal fade" id="hint01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ヒント</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        </div>
                        <div class="modal-body">
                            <p>ブラウザによって見た目は変わりますが、<kbd>Ctrl</kbd>+<kbd>F</kbd>を押すと検索キーワード入力欄が表示されます。<br>
                                (Macの場合は、<kbd>⌘</kbd>+<kbd>F</kbd>)<br>
                                その入力欄に検索したいキーワードを入力するとページ内の一致する文字を見つけることができます。</p>
                            <img src="<?php echo base_url('img/find-hint.png'); ?>" width="100%">
                            <p>iPadの場合は、シェアメニューから「ページを検索」を選んでください。</p>
                            <img src="<?php echo base_url('img/find-hint-ipad.png'); ?>" width="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Modal -->
            <h2>生徒一覧</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>生徒名</th>
                    <th>問題設定</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) : ?>
                <tr id="row_user_id_<?php echo $user['id']; ?>">
                    <td>
                        <?php echo ( ! empty($user['realname'])) ? $user['realname'] : "(未設定)"; ?>
                        <span class="text-info" ><?php echo $user['name']; ?></span><br>
                        <span class="text-muted" ><?php echo $user['directory']; ?></span><br>
                    </td>
                    <td>
                        <ul>
                        <?php foreach ($user['tests'] as $test) : ?>
                        <li><?php echo $test['name']; ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        <!-- Button trigger modal -->
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#<?php echo "myModal".$user['id']; ?>">設定</button>

                        <!-- Modal -->
                        <div class="modal fade" id="<?php echo "myModal".$user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">問題設定</h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    </div>
                                    <?php echo form_open('settings/problems#row_user_id_'.$user['id'],'',array('user_id'=>$user['id'])); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <?php foreach ($tests as $test) : ?>
                                                <label>
                                                    <input type="checkbox" name="test_id[]"
                                                           value="<?php echo $test['id']; ?>"
                                                        <?php foreach ($user['tests'] as $val) : ?>
                                                        <?php if ($val['id'] === $test['id']) : ?>checked<?php endif; ?>
                                                        <?php endforeach; ?>>
                                                    <?php echo $test['name']; ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">更新</button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
