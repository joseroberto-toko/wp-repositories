<?php
/**
 * Template part for displaying stargazers
 */

    $data = get_repository_stargazers($_GET['u'], $_GET['n']);
?>

<section id="wpr">
    <div class="container">
        <?php foreach($data as $key => $value):?>
        <div class="card">
            <div class="adj1">
                <img src="<?=$value->avatar_url?>" alt="">
            </div>
            <div class="txt1">
                <h4><?=$value->login?></h4>
            </div>      
        </div>
        <?php endforeach; ?>
    </div>
</section>

  