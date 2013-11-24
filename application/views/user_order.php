        <div class="panel panel-default" id="userManageReservation">
          <!-- Default panel contents -->
          <div class="panel-heading">List of Products</div>
          <div class="panel-body">
            <p>Order products here. After adding your order, you can view it in view cart page.</p>
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
                <th style="width:270px;">Product Name</th>
                <th>Type</th>
                <th style="text-align:right;padding-right:15px;">Quantity</th>
                <th style="text-align:right;padding-right:15px;">Price</th>
                <th style="text-align:right;padding-right:15px;">Order Quantity</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_of_poducts as $row){

                echo "<tr>";
                echo "<td class='vert productName'>".$row['product_name']."</td>";
                echo "<td class='vert productType'>".$row['product_type']."</td>";
                echo "<td class='vert productQuantity rightalignPadding'>".$row['product_quantity']."</td>";
                echo "<td class='vert productPrice rightalignPadding'>&#8369; ".$row['product_price']."</td>";
                echo '<td class="vert orderQuantity"><input type="text" class="form-control" name="orderQuantity" style="text-align:right;"></td>';
                echo "<td class='vert'><button type='button' data-objectId='".$row['objectId']."' class='btn btn-primary btn-sm editReservation pull-left'>Add to Cart</button>";
                echo "</td>";
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
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Warning!</strong> Fill up all the fields.
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

                <h5 class="message"></h4>
                
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