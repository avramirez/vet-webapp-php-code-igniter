        <div class="alert alert-success addReservationSuccess" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong><strong>
        </div>
        <div class="panel panel-default" id="adminManageReservation">
          <!-- Default panel contents -->
          <div class="panel-heading">Manage Reservations</div>
          <div class="panel-body">
            <p>Reservations of Users can be confirmed and delete here. You can also add new reservations.</p>

           <div class="panel-group" id="accordion" style="margin-bottom:10px;">
            <div class="panel panel-default" id="addOrEditReservation">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <span class="glyphicon glyphicon-hand-right"></span> 
                    <span>Add a Reservation</span>
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse">
                <div class="alert alert-info alert-dismissable" style="display:none;">
                            <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                            <strong>Warning!</strong> Fill up all the fields.
                </div>
                <div class="panel-body clearfix">
                 <form action="addReservation" method="POST" id="addReservationAdmin">
                              <div class="col-md-6">
                                <div id="datepicker" style="margin:0 45px;"></div>
                              </div>
                              <div class="col-md-6">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Reservation Time</h3>
                                  </div>
                                  <div class="panel-body">
                                    <select class="form-control reserveTimeSelect">
                                      <option value=0>Time</option>
                                      <option value="10:00 AM">10:00 AM</option>
                                      <option value="11:00 AM">11:00 AM</option>
                                      <option value="12:00 AM">12:00 PM</option>
                                      <option value="1:00 PM">1:00 PM</option>
                                      <option value="2:00 PM">2:00 PM</option>
                                      <option value="3:00 PM">3:00 PM</option>
                                      <option value="4:00 PM">4:00 PM</option>
                                      <option value="5:00 PM">5:00 PM</option>
                                      <option value="6:00 PM">6:00 PM</option>
                                      <option value="7:00 PM">7:00 PM</option>
                                      <option value="8:00 PM">8:00 PM</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Reservation details</h3>
                                  </div>
                                  <div class="panel-body" style="padding: 5px 15px;">
                                    
                                    <label>Service </label><select class="adminServicesReservation" name="adminServicesReservation" style="width:100%; height:34px;" id="">
                                    <?php 

                                    foreach ($serviceslist as $row){
                                     echo '<option value='.$row['objectId'].'>'.$row['service_name'].'</option>';
                                    }
                                    ?>
                                    </select>

                                    <input type="email" class="form-control" name="reservationUserEmail" id="reservationUserEmail" placeholder="User Email" required>
                                    <h5>Date: <span class="reserveDate"></span></h5>
                                    <h5>Time: <span class="reserveTime"></span></h5>
                                  </div>
                                </div>
                                <input type="hidden" name="reservationId" id="reservationId" value="" />
                                <button type="submit" name="adminAddReservation" id="addReservationButton" class="btn btn-success pull-right" style="margin-top:10px;">Add Reservation</button>
                                <button type="button" name="backToAddReservation" id="backToAddReservation" class="btn btn-success pull-right" id="saveChangesReservation" style="margin-top:10px; margin-right:10px; display:none; display:none;">Back Add Reservation</button>
                                <button type="submit" name="editadminAddReservation" class="btn btn-primary pull-right" id="saveChangesReservation" style="margin-top:10px; margin-right:10px; display:none;">Save Changes</button>

                              </div>

            
                    </form>

                  </div>
                </div>
              </div>
            </div>

             <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
              </span>
              <input type="text" class="form-control" placeholder="Enter keywords">
            </div>
          </div>

          <div style="height:300px; overflow:auto;border: 1px solid rgba(51, 51, 51, 0.17);margin: 5px;">
          <!-- Table -->
          <table class="table table-hover" id="adminReservationTable">
            <thead>
              <tr>
                <th style="width:225px;">Email</th>
                <th style="width:260px;">Service Name</th>
                <th style="">Date</th>
                <th style="">Time</th>
				        <th style="text-align:right;padding-right:20px;">Price</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php 

              foreach ($reservations as $row){
              $date1 = date('Y-m-d H:i A', strtotime(str_replace('-', '/', ''.$row['reserveDate'].' '.$row['reserveTime'].'')));
              $dateToday =date('Y-m-d H:i A');
              if($date1 > $dateToday){
                echo "<tr>";
              }else{
                echo "<tr style='color:#F53838;'>";
              }
              echo "<td class='vert userEmail' style='word-wrap: break-word;word-break: break-all;'>".$row['email']."</td>";
              echo "<td class='vert serviceTitle' data-serviceId='".$row['serviceObjectId']."'>".$row['service_name']."</td>";
              echo "<td class='vert serviceDate'>".$row['reserveDate']."</td>";
              echo "<td class='vert serviceTime'>".$row['reserveTime']."</td>";
              echo "<td class='vert servicePrice rightalignPadding'>&#8369; ".$row['price']."</td>";
              echo "<td class='vert'>";
              if($date1 > $dateToday && $row['confirmed'] == "0"){
                echo "<button type='button' data-objectId='".$row['reservationobjectId']."' class='btn btn-primary btn-sm adminEditReservation pull-left' style='margin-right: 5px;'>Edit</button>";  
                echo "<button type='button' data-objectId='".$row['reservationobjectId']."' class='btn btn-danger btn-sm adminDeleteReservation pull-right'>Delete</button>";
              }else{
                echo "<p style='font-size:10px;'>Reservation Expired!</p>";
                echo "<button style='width:100%;' type='button' data-objectId='".$row['reservationobjectId']."' class='btn btn-danger btn-sm adminDeleteReservation pull-right'>Delete!</button>";
              }
              
              
              echo "</td>";
              echo "<tr>";

     
           
                }
              ?>
            </tbody>
          </table>

        </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
              </div>
              
              <div class="modal-body clearfix">
                Are you sure you want to delete this item?
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary confirmAction" data-confirm="confirmDeleteAdmin">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div>