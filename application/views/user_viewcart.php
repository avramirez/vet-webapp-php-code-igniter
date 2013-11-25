        <div class="alert alert-success cartSuccess" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong><strong>
        </div>
        <div class="panel panel-default" id="viewCartPage">
          <!-- Default panel contents -->
          <div class="panel-heading">List of Orders</div>
          <div class="panel-body">
            <p>Here are the current items in your cart. Press print button to print a receipt that you can present to our staff so your order can be processed.</p>
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
                <th style="text-align:right;padding-right:15px;">Price</th>
                <th style="text-align:right;padding-right:15px;">Amount</th>
                <th style="text-align:right;padding-right:15px;">Total Price</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_of_orders as $row){

                echo "<tr>";
                echo "<td class='vert productName'>".$row['product_name']."</td>";
                echo "<td class='vert productPrice rightalignPadding'>&#8369; <span>".$row['product_price']."</span></td>";
                echo "<td class='vert orderAmount rightalignPadding'>".$row['productAmount']."</td>";
                echo "<td class='vert productTotal rightalignPadding'>&#8369; <span>".$row['totalPrice']."</span></td>";
                echo "<td class='vert'>";
                echo "<button type='button' data-productId='".$row['productObjectId']."' data-objectId='".$row['orderObjectid']."' class='btn btn-primary btn-sm editOrder pull-left' style='margin-right: 5px;'>Edit</button>";
                echo "<button type='button' data-productId='".$row['productObjectId']."' data-objectId='".$row['orderObjectid']."' class='btn btn-danger btn-sm removeFromCart pull-left'>Remove</button>";
                echo "</td>";
                echo "</tr>";

                }
              ?>
            </tbody>
          </table>
        </div>

   
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
              </div>
              
              <div class="modal-body clearfix">
                <div class="removeFromCartBody" style="display:none;">
                    <h4></h4>
                </div>
                <div class="editOrderBody" style="display:none;">
                  <h3 class="orderTitle"></h3>
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Item order details</h3>
                      </div>
                      <div class="panel-body">
                        <p class="detailProductName"></p>
                        <br/>
                        <p class="detailProductAmount">Order Quantity : <input type="number" name="detailProductAmount" style="text-align:right;" class="pull-right"/></p>
                        
                        <p class="detailPrice">Price :  
                          <span class="pull-right value"></span>
                          <span class="pull-right">&#8369</span>
                        </p>
                        <hr />
                        <p class="detailTotalPrice">
                          Total Price :
                          <span class="pull-right value"></span>
                          <span class="pull-right">&#8369</span>
                        </p>
                        <input type="hidden" name="oldValueAmount" value=""/>
                        <input type="hidden" name="detailTotalPrice" value=""/>
                      </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary confirmAction" data-confirm="confirmAddOrder">Yes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div>