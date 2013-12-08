        <div class="alert alert-success cartSuccess" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong><strong>
        </div>
        <div class="panel panel-default" id="viewCartPage">
          <!-- Default panel contents -->
          <div class="panel-heading">Cart Details</div>
          <div class="panel-body">
            <p>Here are the current items in your cart. Press the checkout button to have a printabl receipt of this order.
            You can present your receipt in our hospital so we can proccess your order quickly. But if you don't have a receipt, you 
            could stil claim your order. But it would take a lot more time to process.</p>
            <p>After you claim your order. This page would automatically resets and give you new order number.</p>
            <p class="small">Notes:</p>
            <p class="small">If you present us a receipt, the items that are in the receipt are <strong>the only things we would proccess.</strong>
              In a case wherein you add a item in your order but not included in your receipt, <strong>we would not proccess that item.</strong>
              So please make sure that all items are in your receipt.</p>
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
                <th style="width:140px;"></th>
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
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td>TOTAL:<span style="float:right;margin-right:10px;">&#8369;<?php 
                if(count($list_of_orders) > 0){
                echo $row['totalAll'];
                }
                ?></span></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="clearfix">
          <div style="float:right;margin-bottom:10px;">
            <form action="generateOrderReceipt" method="POST">
            <input type="hidden" value="" />
            <?php
              if(count($list_of_orders) > 0){
                echo "<button type='submit' class='btn btn-warning btn-sm pull-left'>Checkout / Print Receipt</button>";
              }
            ?>
            
            </form>

          </div>
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