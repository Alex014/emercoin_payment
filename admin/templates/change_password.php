<? require 'header.php';?>

    <div class="container" style="width: 400px;">
      <div class="well">
        <form method='post'>
          <div class="form-group<?if($err_field=='pass0'):?> has-error<?endif;?>">
            <label>
              Old password
            </label>
            <input type="password" name='old_pass' class="form-control">
          </div>
          <div class="form-group<?if($err_field=='pass1'):?> has-error<?endif;?>">
            <label>
              New password
            </label>
            <input type="password" name='pass' class="form-control">
          </div>
          <div class="form-group<?if($err_field=='pass2'):?> has-error<?endif;?>">
            <label>
              Repeat new pasword
            </label>
            <input type="password" name='pass2' class="form-control">
          </div>
            <?if(isset($err) && $err !== false):?>
            <div class="alert  alert-danger">
              <p>
                <?=$err?>
              </p>
            </div>
            <?endif;?>
            <?if(isset($err) && $err === false):?>
          <div class="alert  alert-success">
            <p>
              Password changed
            </p>
          </div>
            <?endif;?>
          <button type="submit" name='save' class="btn btn-default">
            Save
          </button>
        </form>
      </div>
    </div>

<? require 'footer.php';?>