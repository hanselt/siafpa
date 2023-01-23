<?php

return array(

  'pdf' => array(
    'enabled' => true,
    'binary'  => php_uname('s') === "Windows NT" ?
                 base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf') :
                 base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
    'timeout' => false,
    'options' => array(
    ),
    'env'     => array(),
  ),
  'image' => array(
    'enabled' => true,
    'binary'  => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltoimage'),
    'timeout' => false,
    'options' => array(),
    'env'     => array(),
  ),

);
