        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Services Offered</div>
          <div class="panel-body">
            <p>Choose from our variety of services. And press reserve button to make a reservation.</p>
            <p><small class="text-muted">Note: Items that are in red are currently not available.</small></p>
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
                <th>Group</th>
                <th style="text-align:right;padding-right:15px;">Price (Incl Tax)</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($services as $row){

                echo "<tr>";
                echo "<td class='vert serviceTitle'>".$row['service_name']."</td>";
                echo "<td class='vert serviceGroup'>".$row['group']."</td>";
                echo "<td class='vert servicePrice rightalignPadding'>&#8369; ".$row['price']."</td>";
                echo "<td class='vert'><button type='button' class='btn btn-primary btn-sm addReservation'>Add reservation</button></td>";
                echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
      </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Confirm reservation</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      
      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div>