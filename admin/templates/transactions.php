<? require 'header.php';?>
  
    <div class="container" style="width: 800px;">
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
          </tr>
          <?endforeach;?>
        </tbody>
      </table>
      <center>
        <ul class="pagination">
          <li>
            <a href="/admin/transactions.php?page=<?=$page_prev?>">Prev</a>
          </li>
          <?for($i=1; $i <= $max_pages; $i++):?>
          <li <?if($page==$i):?> class="active"<?endif;?>>
            <a href="/admin/transactions.php?page=<?=$i?>"><?=$i?></a>
          </li>
          <?endfor;?>
          <li>
            <a href="/admin/transactions.php?page=<?=$page_next?>">Next</a>
          </li>
        </ul>
      </center>
    </div>
    
<? require 'footer.php';?>