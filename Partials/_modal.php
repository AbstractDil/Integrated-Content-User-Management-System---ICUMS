
<!-- Show modal popup -->




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title " id="myModalLabel"> <i class="fa fa-bullhorn blink"></i> <b> Announcements </b></h3>
      </div>
      <div class="modal-body">
      <?php
    $sql = "SELECT * FROM `notices` ORDER BY Date_Time DESC";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num>0){
    
    
       
    while($row = mysqli_fetch_assoc($result)){
    
      ?>

<div class="alert alert-danger">
<strong ><span class="label label-danger  blink">New</span> <a href="<?= $row['notice_link']; ?>" class="text-danger"><?= $row['notice_title']; ?></a> <span class="label label-info">Posted On <?= $row['Date_Time']; ?></span>  </strong>
</div>

      <?php
     
    
    }
    }
  
    ?>
      </div>
      <div class="modal-footer bg-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<!-- End modal popup -->
