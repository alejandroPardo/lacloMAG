<!-- expense report -->
<html>
<body>
  <h3>Expense Report</h3>
  <table>
      <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Role</th>
      </tr>
      <?php
      $count = 0; $total = 0;
      foreach($data as $d): ?>
      <tr>
          <td><?php echo $d['User']['id']; ?></td>
          <td><?php echo $d['User']['username']; ?></td>
          <td><?php echo $d['User']['role']; ?></td>
      </tr>
      <?php
      $count++;
      endforeach; ?>
      <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
      </tr>
      <tr>
          <td><b>Totals:</b></td>
          <td><?php echo $total; ?></td>
          <td><?php echo $count; ?> items</td>
      </tr>
  </table>
</body>
</html>
<!-- end report -->