<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $blogPost->getPostTitle();?></title>
    <link rel="stylesheet" href="{{ asset('bundles/acmeblog/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('bundles/acmeblog/css/main.css') }}" />
</head>
<body>

<div id="wrapper">

    <h1>Blog</h1>
    <hr />
    <p><a href="./">Blog Index</a></p>


    <?php
    echo '<div>';
    echo '<h1>'.$blogPost->getPostTitle().'</h1>';
    echo '<p>Posted on '.date_format($blogPost->getPostDate(),'jS M Y H:i:s').'</p>';
    echo '<p>'.$blogPost->getPostCont().'</p>';
    echo '</div>';
    ?>

</div>


</body>
</html>