<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand visible-xs" href="<?php echo ROOT_DIR; ?>"><img src="<?php echo ROOT_DIR.'img/logo.png' ?>" height="60px" alt="hiragana.ch"></a>
          <a class="navbar-brand hidden-xs" href="<?php echo ROOT_DIR; ?>"><img src="<?php echo ROOT_DIR.'img/logo_full.png' ?>" height="80px" alt="hiragana.ch"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <?php $nav = array(
          array('id' => 'home', 'name' => I18n::t('navigation.home'), 'url' => ROOT_DIR.'home'),
          array('id' => 'hiragana', 'name' => 'Hiragana', 'url' => ROOT_DIR.'kana/hiragana'),
          array('id' => 'katakana', 'name' => 'Katakana', 'url' => ROOT_DIR.'kana/katakana'),
          //array('id' => 'courses', 'name' => I18n::t('navigation.courses'), 'url' => ROOT_DIR.'courseoverview'),
          array('id' => 'feedback', 'name' => 'Feedback', 'url' => ROOT_DIR.'feedback'),
        ); ?>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php for ($i=0; $i < count($nav); $i++): ?>
              <li id="<?php echo $nav[$i]['id'] ?>"><a href="<?php echo $nav[$i]['url'] ?>"><?php echo $nav[$i]['name'] ?></a></li>
            <?php endfor;
              //echo '<li class="visible-xs"><a href="'.ROOT_DIR.'login"><strong>'.I18n::t('text.signin').'</strong></a></li>';
              //echo '<li class="visible-xs"><a href="'.ROOT_DIR.'register"><strong>'.I18n::t('text.register').'</strong></a></li>';
            ?>
          </ul>

          <?php if (Auth::isLoggedIn()) { // USER MENU ?>
          <ul class="nav navbar-nav navbar-right">
            <?php if (Auth::isAdmin()) { // ADMIN MENU ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo ROOT_DIR; ?>admin/useroverview"><?php echo I18n::t('navigation.admin.users'); ?></a></li>
                <li><a href="<?php echo ROOT_DIR; ?>admin/courseadmin"><?php echo I18n::t('navigation.admin.courses'); ?></a></li>
              </ul>
            </li>
            <?php } // end if isAdmin ?>
            <li><a href="<?php echo ROOT_DIR; ?>usersettings"><?php echo I18n::t('navigation.usersettings'); ?></a></li>
            <li><a href="<?php echo ROOT_DIR; ?>api/logout.php"><?php echo I18n::t('text.signout'); ?></a></li>
          </ul>
          <?php } // end if isLoggedIn ?>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
