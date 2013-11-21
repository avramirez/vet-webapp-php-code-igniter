        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">Services Offered</div>
          <div class="panel-body">
            <p>Choose from our variety of services. And press reserve button to make a reservation.</p>
            <small>Note: Items that are in red are not currently available.</small>
          </div>

          <!-- Table -->
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Service Name</th>
                <th>Group</th>
                <th>Price (Incl Tax)</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($services as $row){

                echo "<tr><td>".$row['service_name']."</td><td>".$row['group']."</td><td>&#8369; ".$row['price']."</td></tr>";

                }
              ?>
            </tbody>
          </table>
        </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>

      <div class="footer">
        <p>&copy; Company 2013</p>
      </div>

    </div>