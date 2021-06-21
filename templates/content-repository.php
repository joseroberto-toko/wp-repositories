<?php
/**
 * Template part for displaying filter results
 */

  $data = get_user_repositories($_GET['u']);
?>

<section id="wpr">
  <div class="main-header large" >
    <div class="header-container">
      <div class="user-profile-sticky-bar">
        <div class="user-profile-mini-card">
          <span class="user-profile-mini-avatar">
            <img class="avatar-user avatar-identifier" src="<?=plugins_url( 'wp-repositories/assets/images/default-user-iamge.png') ?>" width="32" height="32" alt="@<?=$data["user"]->login?>">
          </span>
          <span>
            <strong class="username-identifier"><?=$data["user"]->login?></strong>
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="content-container">
    <div class="user-details">
      <div class="user-image-name">
        <div class="user-image">
          <img style="height:auto;" alt="" class="avatar-user avatar-identifier" src="<?=$data["user"]->avatar_url?>">
          <div class="user-status-circle-badge">
            <div class="user-status-emoji-container ">
              <svg class="octicon octicon-smiley" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zM5 8a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zM5.32 9.636a.75.75 0 011.038.175l.007.009c.103.118.22.222.35.31.264.178.683.37 1.285.37.602 0 1.02-.192 1.285-.371.13-.088.247-.192.35-.31l.007-.008a.75.75 0 111.222.87l-.614-.431c.614.43.614.431.613.431v.001l-.001.002-.002.003-.005.007-.014.019a1.984 1.984 0 01-.184.213c-.16.166-.338.316-.53.445-.63.418-1.37.638-2.127.629-.946 0-1.652-.308-2.126-.63a3.32 3.32 0 01-.715-.657l-.014-.02-.005-.006-.002-.003v-.002h-.001l.613-.432-.614.43a.75.75 0 01.183-1.044h.001z"></path></svg>
              <span class="set-status-text"> Status</span>              
            </div>
          </div>
        </div>
        <div class="user-names">
          <h4 class="vcard-names ">
            <span class="name name-identifier"><?=$data["user"]->name?></span>
            <span class="nickname username-identifier"><?=$data["user"]->login?></span>
          </h4>
        </div>
      </div>
      <div class="user-status-circle-badge mobile">
        <div class="user-status-emoji-container ">
          <svg class="octicon octicon-smiley" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zM5 8a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zM5.32 9.636a.75.75 0 011.038.175l.007.009c.103.118.22.222.35.31.264.178.683.37 1.285.37.602 0 1.02-.192 1.285-.371.13-.088.247-.192.35-.31l.007-.008a.75.75 0 111.222.87l-.614-.431c.614.43.614.431.613.431v.001l-.001.002-.002.003-.005.007-.014.019a1.984 1.984 0 01-.184.213c-.16.166-.338.316-.53.445-.63.418-1.37.638-2.127.629-.946 0-1.652-.308-2.126-.63a3.32 3.32 0 01-.715-.657l-.014-.02-.005-.006-.002-.003v-.002h-.001l.613-.432-.614.43a.75.75 0 01.183-1.044h.001z"></path></svg>
        </div>
        <span>Set status</span>
      </div>
      <div class="user-bio bio-identifier">
        <?=$data["user"]->bio?>
      </div>
    </div>


      <div class="main-header mobile">
        <div class="header-container">
          <div class="user-profile-sticky-bar">
            <div class="user-profile-mini-card">
              <span class="user-profile-mini-avatar">
                <img class="avatar-user avatar-identifier" src="<?=$data["user"]->avatar_url?>" width="32" height="32" alt="@<?=$data["user"]->login?>">
              </span>
              <span>
                <strong><?=$data["user"]->login?></strong>
              </span>
            </div>
          </div>
          <div class="tabs">
            <nav>
              <a href="#" class="underline-nav-item">
                <svg aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="16" width="16" class="octicon octicon-repo UnderlineNav-octicon hide-sm">
                  <path fill-rule="evenodd" d="M2 2.5A2.5 2.5 0 014.5 0h8.75a.75.75 0 01.75.75v12.5a.75.75 0 01-.75.75h-2.5a.75.75 0 110-1.5h1.75v-2h-8a1 1 0 00-.714 1.7.75.75 0 01-1.072 1.05A2.495 2.495 0 012 11.5v-9zm10.5-1V9h-8c-.356 0-.694.074-1 .208V2.5a1 1 0 011-1h8zM5 12.25v3.25a.25.25 0 00.4.2l1.45-1.087a.25.25 0 01.3 0L8.6 15.7a.25.25 0 00.4-.2v-3.25a.25.25 0 00-.25-.25h-3.5a.25.25 0 00-.25.25z"></path>
                </svg>
                Repositories
                <span class="counter"></span>
              </a>
            </nav>
          </div>
        </div>
        <div class="line"></div>
      </div>


    <div class="tab-details">
      <div class="search-repository">
        <input type="search" placeholder="Buscar repositório..." id="filter" onkeyup="filter_repositorios()">
      </div>
      <div class="user-repositories-list">
        <ul class="repositories-list-identifier" id="repositories_list">
        <?php
          foreach($data["repos"] as $key => $value):
        ?>
        <li>
            <div class="repository-details">
              <h3>
                <a href="<?=$value->html_url?>" target="_blank"><?=$value->name?></a>
                <?php echo $value->private ? '<span class="Private-label">Private</span>' : "" ?>
              </h3>
              <p class="description">
                <?=$value->description?>
              </p>
              <div class="language-and-timestamp">  
                <span class="repo-language">
                  <?php echo $value->language ? '<span class="programming-language"> '.$value->language .'</span>' : ""?>
                </span> 
                <?php echo $value->stargazers_count ? '<a class="star-count" href="/stargazers/?u='.$data["user"]->login.'&n='.$value->name.'">
                    <svg aria-label="star" class="octicon octicon-star" viewBox="0 0 16 16" version="1.1" width="16" height="16" role="img"><path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z"></path></svg>
                    '.$value->stargazers_count.'
                  </a>' : "0" 
                ?>
              </div>
            </div>
        </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
  

  s