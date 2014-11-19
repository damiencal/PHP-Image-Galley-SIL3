<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PHP MVC Image Gallery</title>
    <meta name="description" content="php MVC image gallery">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css">
    <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo URL; ?>">PHP Image Gallery SIL3</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL; ?>">Home</a>
                </li>
                <li><a href="<?php echo URL; ?>home/about">About</a>
                </li>
                <li><a href="<?php echo URL; ?>gallery">Gallery</a>
                </li>
                <li><a href="<?php echo URL; ?>album">Album</a>
                </li>
            </ul>
        </div>
    </div>
    <noscript>
    <div class="alert alert-danger">You must enable Javascript on your browser for the site to work optimally and display sections completely.
    </div>
</noscript>
</nav>
