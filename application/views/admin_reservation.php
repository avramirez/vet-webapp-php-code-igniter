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
          <span class="glyphicon glyphicon-hand-right"></span> Add a Reservation
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
                                      <option value=1>6:00 AM</option>
                                      <option value=2>7:00 AM</option>
                                      <option value=3>8:00 AM</option>
                                      <option value=4>9:00 AM</option>
                                      <option value=5>10:00 AM</option>
                                      <option value=6>11:00 AM</option>
                                      <option value=7>12:00 PM</option>
                                      <option value=8>2:00 PM</option>
                                      <option value=9>3:00 PM</option>
                                      <option value=10>4:00 PM</option>
                                      <option value=11>5:00 PM</option>
                                      <option value=12>6:00 PM</option>
                                      <option value=13>7:00 PM</option>
                                      <option value=14>8:00 PM</option>
                                      <option value=15>9:00 PM</option>
                                      <option value=16>10:00 PM</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h3 class="panel-title">Reservation details</h3>
                                  </div>
                                  <div class="panel-body" style="padding: 5px 15px;">
                                    <input type="email" class="form-control" name="reservationUserEmail" id="reservationUserEmail" placeholder="User Email" required>
                                    <h5>Date: <span class="reserveDate"></span></h5>
                                    <h5>Time: <span class="reserveTime"></span></h5>
                                  </div>
                                </div>
                                <button type="submit" name="adminAddReservation" class="btn btn-success pull-right" style="margin-top:10px;">Add Reservation</button>
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
                <th style="">Email</th>
                <th>Username</th>
                <th style="">Full Name</th>
                <th style="width:200px;">Service Name</th>
                <th style="">Date</th>
                <th style="">Time</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php 

              foreach ($reservations as $row){

                // echo "<tr>";
                // echo "<td class='vert userEmail'>".$row['email']."</td>";
                // echo "<td class='vert userUsername'>".$row['username']."</td>";
                // echo "<td class='vert userFirstName'>".$row['first_name']."</td>";
                // echo "<td class='vert userLastName'>".$row['last_name']."</td>";
                // echo "<td class='vert userUserLevel'>";
                //   if($row['user_level'] == 1){
                //     echo "<span data-userlevel=".$row['user_level'].">User</span>";
                //   }else if($row['user_level'] == 2){
                //     echo "<span data-userlevel=".$row['user_level'].">Super Admin</span>";
                //   }else if($row['user_level'] == 3){
                //     echo "<span data-userlevel=".$row['user_level'].">Admin User</span>";
                //   }else if($row['user_level'] == 3){
                //     echo "<span data-userlevel=".$row['user_level'].">Admin Resertvation</span>";
                //   }
                // echo "</td>";
                // echo "<td class='vert'>";
                // echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-primary btn-sm editUserFromAdmin pull-left' style='margin-right: 5px;'>Edit</button>";
                // echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-danger btn-sm removeUserFromAdmin pull-right'>Delete</button>";
                // echo "</td>";
                // echo "</tr>";
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