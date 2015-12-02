<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <?php $nav = array(
          array('id' => 'home', 'name' => I18n::t('navigation.home'), 'url' => ROOT_DIR.'home'),
          array('id' => 'hiragana', 'name' => 'Hiragana', 'url' => ROOT_DIR.'hiragana'),
          array('id' => 'katakana', 'name' => 'Katakana', 'url' => ROOT_DIR.'katakana'),
          array('id' => 'japanese', 'name' => I18n::t('navigation.japanese'), 'url' => ROOT_DIR.'japanese'),
          array('id' => 'score', 'name' => 'Score', 'url' => ROOT_DIR.'score')
        ); ?>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php for ($i=0; $i < count($nav); $i++): ?>
              <li id="<?php echo $nav[$i]['id'] ?>"><a href="<?php echo $nav[$i]['url'] ?>"><?php echo $nav[$i]['name'] ?></a></li>
            <?php endfor; ?>
              <li class="visible-xs"><a href="#" style="color: rgba(200,0,0,0.8);">Login</a></li>
              <li class="visible-xs"><a href="" style="color: rgba(200,200,0,0.8);">Register</a></li>
          </ul>

          <?php if (Auth::isLoggedIn()) { // USER MENU ?>
          <ul class="nav navbar-nav navbar-right">
            <?php if (Auth::isAdmin()) { // ADMIN MENU ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo ROOT_DIR; ?>admin/useroverview">Users</a></li>
                <li><a href="<?php echo ROOT_DIR; ?>admin/courseoverview">Courses</a></li>
              </ul>
            </li>
            <?php } // end if isAdmin ?>
            <li><a href="<?php echo ROOT_DIR; ?>usersettings">User Settings</a></li>
            <li><a href="<?php echo ROOT_DIR; ?>api/logout.php">Logout</a></li>
          </ul>
          <?php } // end if isLoggedIn ?>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
