        <div class="alert alert-success alert-dismissable reservationAlert" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong><strong>
        </div>
        <div class="panel panel-default" id="userManageReservation">
          <!-- Default panel contents -->
          <div class="panel-heading">List of Reservations</div>
          <div class="panel-body">
            <p>Here you can manage your reservation. You could either delete or edit.</p>
             <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
              </span>
              <input type="text" class="form-control" placeholder="Enter keywords">
            </div>
          </div>

          <!-- Table -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Service Name</th>
                <th style="text-align:right;padding-right:15px;">Price (Incl Tax)</th>
                <th>Reservation Date</th>
                <th>Reservation Time</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_of_reservations as $row){

                echo "<tr>";
                echo "<td class='vert serviceTitle'>".$row['service_name']."</td>";
                echo "<td class='vert servicePrice rightalignPadding'>&#8369; ".$row['price']."</td>";
                echo "<td class='vert serviceDate'>".$row['reserveDate']."</td>";
                echo "<td class='vert serviceTime'>".$row['reserveTime']."</td>";
                echo "<td class='vert'><button type='button' data-objectId='".$row['reservationobjectId']."' class='btn btn-primary btn-sm editReservation pull-left'>Edit</button>";
                echo "<button type='button' data-objectId='".$row['reservationobjectId']."' class='btn btn-danger btn-sm deleteReservation pull-right'>Delete</button></td>";
                echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editReserveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>

              <div class="modal-body clearfix">
                <div class="alert alert-info alert-dismissable" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong>Warning!</strong> Fill up all the fields.
                </div>
                <div class="col-md-6">
                  <div id="datepicker"></div>
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
                      <h5>Date: <span class="reserveDate"></span></h5>
                      <h5>Time: <span class="reserveTime"></span></h5>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updateReservation">Update Reservation</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">&nbsp;</h4>
              </div>

              <div class="modal-body clearfix">

                <h5 class="message">Are you sure you want to delete this item?</h4>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary confirmAction">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div>