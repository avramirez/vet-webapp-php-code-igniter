        <div class="alert alert-success addUserSuccess" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong><strong>
        </div>
        <div class="panel panel-default" id="adminViewOrder">
          <!-- Default panel contents -->
          <div class="panel-heading">List of Products</div>
          <div class="panel-body">

           
             <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
              </span>
              <input type="text" class="form-control" placeholder="Enter keywords">
            </div>
          </div>

          <div style="height:300px; overflow:auto;border: 1px solid rgba(51, 51, 51, 0.17);margin: 5px;">
          <!-- Table -->
          <table class="table table-hover" id="adminUsersTable">
            <thead>
              <tr>
			  <th style="width:160px">Product ID</th>
                <th style="width:270px;">Product Name</th>
                <th style="">Quantity</th>
                <th style="">Price</th>
				  <th style="">Product Type</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($products as $row){
                echo "<tr>";
                echo "<td class='vert productObjectId'>".$row['objectId']."</td>";
                echo "<td class='vert productName'>".$row['product_name']."</td>";
                echo "<td class='vert productQuanitty'>".$row['product_quantity']."</td>";
                echo "<td class='vert productPrice'>".$row['product_price']."</td>";
                echo "<td class='vert productType'>".$row['product_type']."</td>";
                echo "<td class='vert'>";
                echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-primary btn-sm editUserFromAdmin pull-left' style='margin-right: 5px;'>Edit</button>";
                echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-danger btn-sm removeUserFromAdmin pull-right'>Delete</button>";
                echo "</td>";
                echo "</td>";
                echo "</tr>";
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