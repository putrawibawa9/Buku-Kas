<?php
require_once '../Resource/header.php'; 
require_once '../Controller/Transaction.php'; 


$income = new Transaction;
$income = $income->readIncome();


$outcome = new Transaction;
$outcome = $outcome->readOutcome();

?>



<div class="container">
    <div class="row">
    <h3 class="text-center mb-5 mt-5">BUKU KAS 2024</h3>
      <div class="col-md-6">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">Total Income</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center"> Rp.<?= number_format($income, 0, ',', '.')?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-6">
      <table class="table">
          <thead>
            <tr>
              <th class="text-center">Total Outcome</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td class="text-center"> Rp.<?= number_format($outcome, 0, ',', '.')?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


<?php require_once '../Resource/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.category-list').addClass('active');
</script>
 
