<?php

// 0:退会済 1:仮登録 2:メール認証済

return [
  'USER_STATUS' => ['DEACTIVE' => '0', 'PRE_REGISTER' => '1', 'MAIL_AUTHED' => '2'],


  // ユーザーの権限　0:一般ユーザー 1:サイト編集者　2:サイト管理者
  'ADMIN_RANK' => ['USER' => '0', 'PRE_ADMINER'=>'1','ADMINER'=>'2'],

  // 1:利用停止
  'DISABLED_STATUS' => ['DISABLED' => '1'],
];
