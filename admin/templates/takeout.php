<? require 'header.php';?>

    <div class="container" style="width: 400px;">
      <div class="well">
        <form method="post">
          <div class="form-group<?if($a_err_field=='ammount'):?> has-error<?endif;?>">
            <label>
              Auto pay-out ammount
            </label>
            <input type="text" name="ammount" value="<?=htmlentities($_ammount)?>" class="form-control" value="10.000000">
          </div>
          <div class="form-group<?if($a_err_field=='address'):?> has-error<?endif;?>">
            <label>
              Pay-out address
            </label>
            <input type="text" name="address" value="<?=htmlentities($_address)?>" class="form-control">
          </div>
          <?if($a_err === 'addr_ok'):?>
          <div class="alert  alert-success">
            <p>
              Address and ammount changed
            </p>
          </div>
          <?elseif(isset($a_err) && $a_err !== false):?>
          <div class="alert  alert-danger">
            <p>
              <?=$a_err?>
            </p>
          </div>
          <?endif;?>
          <button type="submit" name='save' class="btn btn-default">
            Save
          </button>
        </form>
      </div>
    </div>
    
    <div class="container" style="width: 400px;">
      <div class="well">
        <form method="post">
          <label class="checkbox">
            <input type="checkbox" name="all" id="takeall">
            Take out all
          </label>
          
          <div class="form-group" id="takeammount">
            <label>
              Take out
            </label>
            <input type="text" name="ammount" class="form-control" value="<?=htmlentities($__ammount)?>">
          </div>
          
          <?if($t_err === 'takeout_ok'):?>
          <div class="alert  alert-success">
            <p>
              Money has been sent
            </p>
          </div>
          <?elseif(isset($t_err) && $t_err !== false):?>
          <div class="alert  alert-danger">
            <p>
              <?=$t_err?>
            </p>
          </div>
          <?endif;?>
          <button type="submit" name='takeout' class="btn btn-default">
            Take out
          </button>
        </form>
      </div>
    </div>

<script>
$('#takeall').change(function() {
  if($(this).attr('checked'))
    $('#takeammount').hide()
  else
    $('#takeammount').show()
})
</script>
    
<? require 'footer.php';?>