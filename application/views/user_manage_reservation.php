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
                echo "<td class='vert serviceGroup'>".$row['reserveDate']."</td>";
                echo "<td class='vert serviceGroup'>".$row['reserveTime']."</td>";
                echo "<td class='vert'><button type='button' data-objectId='".$row['objectId']."' class='btn btn-primary btn-sm editReservation pull-left'>Edit</button>";
                echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-danger btn-sm deleteReservation pull-right'>Delete</button></td>";
                echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>


      
      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div>