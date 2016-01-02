<?php require AUTH_DIR.'requirelogin.routine.php'; ?>

<h1>User Settings</h1>

<div ng-app="hiragana">
  <div ng-controller="ColorController">
    <form novalidate class="form-horizontal">

      <div class="form-group">
        <label for="color" class="control-label col-sm-2">Color (hex)</label>
        <div class="col-sm-6">
          <input type="text" ng-model="user.color" class="form-control" id="color" name="color"/>
        </div>
      </div>

      <button type="submit" ng-click="reset(user)" class="btn btn-default" name="submitted">Reset</button>

    </form>
  </div>
</div>
