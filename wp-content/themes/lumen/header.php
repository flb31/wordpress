<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">
  <head>
    <title><?= get_query_var( Conf::PREFIX . 'title') ?></title>
    <meta charset="utf-8">
    <meta content="<?= get_query_var( Conf::PREFIX . 'description') ?>" name="description">
    <meta content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width" name="viewport">
    <meta name="theme-color" content="">
    <meta name="msapplication-navbutton-color" content="">
    <meta name="apple-mobile-web-app-status-bar-style" content="">
    <?php do_action( Conf::PREFIX . 'head' ); ?>
  </head>
  <body>
