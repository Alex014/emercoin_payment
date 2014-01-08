<? require 'header.php';?>
  
    <div class="container" style="width: 1000px;">
      <table class="table">
        <tbody>
          <tr>
            <th>
              Date
            </th>
            <th>
              Address
            </th>
            <th>
              Ammount
            </th>
            <th>
              Comment
            </th>
          </tr>
          <?foreach($ransactions as $transaction):?>
          <tr>
            <td>
              <?=$transaction['date']?>
            </td>
            <td>
              <?=$transaction['address']?>
            </td>
            <td>
              <?=$transaction['ammount']?>
            </td>
            <td>
              <?=$transaction['comment']?>
            </td>
          </tr>
          <?endforeach;?>
        </tbody>
      </table>
      <?if($count > 20):?>
      <center>
        <ul class="pagination">
          <li>
            <a href="transactions.php?page=<?=$page_prev?>">Prev</a>
          </li>
          <?for($i=1; $i <= $max_pages; $i++):?>
          <li <?if($page==$i):?> class="active"<?endif;?>>
            <a href="transactions.php?page=<?=$i?>"><?=$i?></a>
          </li>
          <?endfor;?>
          <li>
            <a href="transactions.php?page=<?=$page_next?>">Next</a>
          </li>
        </ul>
      </center>
      <?endif;?>
    </div>
    
<? require 'footer.php';?>