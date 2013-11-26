        <div class="alert alert-success addUserSuccess" style="display:none;">
                  <button type="button" class="close" data-hide="alert" aria-hidden="true">&times;</button>
                  <strong><strong>
        </div>
        <div class="panel panel-default" id="adminAddUser">
          <!-- Default panel contents -->
          <div class="panel-heading">List of Users</div>
          <div class="panel-body">
            <p>Here you can manage your users, who registered to your website.</p>
            <div class="panel panel-default panelAddEditUser">
                    <div class="panel-heading">
                      <h3 class="panel-title">Add a User</h3>
                    </div>
                    <div class="panel-body">
                      <form action="admin/addUser" method="POST" id="addUserAdmin" name="adduseradmin">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th style="width:200px;">Email</th>
                              <th>Username</th>
                              <th style="">First Name</th>
                              <th style="">Last Name</th>
                              <th style="">User Level</th>
                              <th style="">Password</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter email" required></td>
                              <td><input type="text" class="form-control" name="username" id="username" placeholder="Username" required></td>
                              <td><input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required></td>
                              <td><input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required></td>
                              <td>
                                <select class="form-control" name="userLevel">
                                  <option value=1>User</option>
                                  <option value=3>Admin - User</option>
                                  <option value=4>Admin - Resertvation</option>
                                  <option value=2>Super Admin</option>
                                </select>
                              </td>
                              <td> <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password" minlength="6" maxlength="50" required></td>
                            </tr>
                          </tbody>
                        </table>
                         <button type="submit" name="adduserbtn" class="btn btn-success pull-right">Add User</button>
                      </form>
                      <form action="admin/updateUser" method="POST" id="updateUser" name="updateuseradmin" style="display:none;">
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th style="width:200px;">Email</th>
                              <th>Username</th>
                              <th style="">First Name</th>
                              <th style="">Last Name</th>
                              <th style="">User Level</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><input type="email" class="form-control" name="inputEmailUpdate" id="inputEmail" placeholder="Enter email" required></td>
                              <td><input type="text" class="form-control" name="usernameUpdate" id="username" placeholder="Username" required></td>
                              <td><input type="text" class="form-control" name="firstNameUpdate" id="firstName" placeholder="First Name" required></td>
                              <td><input type="text" class="form-control" name="lastNameUpdate" id="lastName" placeholder="Last Name" required></td>
                              <td>
                                <select class="form-control" name="userLevelUpdate">
                                  <option value=1>User</option>
                                  <option value=3>Admin - User</option>
                                  <option value=4>Admin - Resertvation</option>
                                  <option value=2>Super Admin</option>
                                </select>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                         <button type="button" data-objectid="1" name="backtoadd" class="btn btn-success backToAddUser pull-right">Back to Add User</button>
                         <button type="submit" class="btn btn-primary pull-right" name="updateuserbtn" style="margin-right:10px;">Save Changes</button>
                      </form>
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
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="width:270px;">Email</th>
                <th>Username</th>
                <th style="">First Name</th>
                <th style="">Last Name</th>
                <th style="">User Level</th>
                <th style="width:130px;"></th>
              </tr>
            </thead>
            <tbody>
              <?php 

              foreach ($users as $row){

                echo "<tr>";
                echo "<td class='vert userEmail'>".$row['email']."</td>";
                echo "<td class='vert userUsername'>".$row['username']."</td>";
                echo "<td class='vert userFirstName'>".$row['first_name']."</td>";
                echo "<td class='vert userLastName'>".$row['last_name']."</td>";
                echo "<td class='vert userUserLevel'>";
                  if($row['user_level'] == 1){
                    echo "<span data-userlevel=".$row['user_level'].">User</span>";
                  }else if($row['user_level'] == 2){
                    echo "<span data-userlevel=".$row['user_level'].">Admin</span>";
                  }
                echo "</td>";
                echo "<td class='vert'>";
                echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-primary btn-sm editUserFromAdmin pull-left' style='margin-right: 5px;'>Edit</button>";
                echo "<button type='button' data-objectId='".$row['objectId']."' class='btn btn-danger btn-sm removeUserFromAdmin pull-right'>Delete</button>";
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
                <h4 class="modal-title" id="myModalLabel">Confirm Order</h4>
              </div>
              
              <div class="modal-body clearfix">
                <h3 class="orderTitle"></h3>
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h3 class="panel-title">Item order details</h3>
                    </div>
                    <div class="panel-body">
                      <p class="detailProductName"></p>
                      <p class="detailProductType">Type : <span class="pull-right"></span></p>
                      <p class="detailProductAmount">Order Quantity : <span class="pull-right"></span></p>
                      <input type="hidden" name="detailProductAmount" value=""/>
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
                      <input type="hidden" name="detailTotalPrice" value=""/>
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