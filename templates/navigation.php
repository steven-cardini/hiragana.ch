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
          array('id' => 'hiragana', 'name' => 'Hiragana', 'url' => ROOT_DIR.'hiragana'),
          array('id' => 'katakana', 'name' => 'Katakana', 'url' => ROOT_DIR.'katakana'),
          array('id' => 'word-trainer', 'name' => 'Word Trainer', 'url' => ROOT_DIR.'word-trainer'),
          array('id' => 'score', 'name' => 'Score', 'url' => ROOT_DIR.'score')
        ); ?>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php for ($i=0; $i < count($nav); $i++): ?>
              <li id="<?php echo $nav[$i]['id'] ?>"><a href="<?php echo $nav[$i]['url'] ?>"><?php echo $nav[$i]['name'] ?></a></li>
            <?php endfor; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Login</a></li>
            <?php if (true): ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User-Settings <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            <?php endif; ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
