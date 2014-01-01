        <div class="panel panel-default" id="adminUsersOrder">
          <!-- Default panel contents -->
          <div class="panel-heading">Billing</div>
          <div class="panel-body">
          <div>
            <!-- <p>Only confirmed transactions are being calculated here.</p> -->
          </div>
          <form id="billing" role="form" action="generateBilling" method="POST">
          <div class="form-group col-md-5">
            <label for="username">Customer</label>
           
                        <select class="form-control customer" name="customer">
                            <?php 
                            foreach ($customers as $row){
                                echo'<option value="'.$row['objectId'].'">'.$row['last_name'].', '.$row['first_name'].'  ('.$row['email'].')</option>';
                              }
                            ?>
                         
                        </select>
          </div>
          <div class="form-group col-md-5">
            <label for="username">Pet Name</label>
            <input type="text" class="form-control" name="petName" id="petName" placeholder="Pet Name" minlength="3" required>          
          </div>
          <div class="form-group col-md-5">
            <label for="username">Doctor</label>
           
                        <select class="form-control doctor" name="doctor">
                            <?php 
                            foreach ($docs as $row){
                                echo'<option value="'.$row['objectId'].'">'.$row['doctor_name'].'</option>';
                              }
                            ?>
                         
                        </select>
          </div>

          <div class="form-group col-md-5">
            <label for="username">Surgery</label>
           
                        <select class="form-control surgery" name="surgery">
                            <?php 
                            foreach ($surgerys as $row){
                                echo'<option value="'.$row['objectId'].'">'.$row['service_name'].' (P '.number_format($row['price'],2).')</option>';
                              }
                            ?>
                         
                        </select>
          </div>

          <br style="clear:both;" />
          <label>Date of confinement</label>
          <div class="row">
                    <div class="col-md-6 noPadding">
                      <div class="col-md-12">
                      <label> From</label>
                      </div>
                      <div class="col-md-5">
                        <select class="form-control reportMonthFrom" name="reportMonthFrom">
                          <option value="01">January</option>
                          <option value="02">February</option>
                          <option value="03">March</option>
                          <option value="04">April</option>
                          <option value="05">May</option>
                          <option value="06">June</option>
                          <option value="07">July</option>
                          <option value="08">August</option>
                          <option value="09">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                      </div>
                      <div class="col-md-2" style='padding:0px;'>
                        <select class="form-control reportDayFrom" name="reportDayFrom">
                         <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select class="form-control reportYearFrom" name="reportYearFrom">
                          <option value="0">Year</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                          <option value="1999">1999</option>
                          <option value="1998">1998</option>
                          <option value="1997">1997</option>
                          <option value="1996">1996</option>
                          <option value="1995">1995</option>
                          <option value="1994">1994</option>
                          <option value="1993">1993</option>
                          <option value="1992">1992</option>
                          <option value="1991">1991</option>
                          <option value="1990">1990</option>
                          <option value="1989">1989</option>
                          <option value="1988">1988</option>
                        </select>
                      </div>
                    </div>
               
                   <div class="col-md-5 noPadding">
                      <div class="col-md-12">
                      <label> To</label>
                      </div>
                      <div class="col-md-6">
                        <select class="form-control reportMonthTo" name="reportMonthTo">
                          <option value="01">January</option>
                          <option value="02">February</option>
                          <option value="03">March</option>
                          <option value="04">April</option>
                          <option value="05">May</option>
                          <option value="06">June</option>
                          <option value="07">July</option>
                          <option value="08">August</option>
                          <option value="09">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                      </div>
                      <div class="col-md-2" style='padding:0px;'>
                        <select class="form-control reportDayTo" name="reportDayTo">
                         <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <select class="form-control reportYearTo" name="reportYearTo">
                          <option value="0">Year</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                          <option value="1999">1999</option>
                          <option value="1998">1998</option>
                          <option value="1997">1997</option>
                          <option value="1996">1996</option>
                          <option value="1995">1995</option>
                          <option value="1994">1994</option>
                          <option value="1993">1993</option>
                          <option value="1992">1992</option>
                          <option value="1991">1991</option>
                          <option value="1990">1990</option>
                          <option value="1989">1989</option>
                          <option value="1988">1988</option>
                        </select>
                      </div>
                    </div>
          </div>
          <button type="submit" class="btn btn-sm btn-info" style="float:right;margin-top:10px;" id="generateReservationReport">Generate Billing</button>
          </form>
        </div>
      </div>


      <div class="footer">
        <p> &copy; Company 2013</p>
      </div>

    