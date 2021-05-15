
<div id="content_container">
  <div class="content">
    <div id="left-panel">

      <h3>
        Expenses Report
      </h3>

      <div class="tab">
      <a href="/download">Download</a>
      </div>

      <form enctype="multipart/form-data" action="upload" method="post">
      <div class="upload-container">
        <div id="label">
          <label>Upload a new CSV file</label>
        </div>
        <input siz="50" type="file" name="filename">
        <input type="submit" name="submit" value="Upload">
      </div>
      </form>
    </div>

    <div id="top-right-panel">
		<table>
  		<thead>
    		<tr>
          <th scope="col">  </th>
          <th scope="col">Category</th>
          <th scope="col">Total Cost</th>
        </tr>
  		</thead>
  		<tbody>
  			<?php $row = 1; ?>
  			<?php foreach ($params as $key => $value) { ?>	
    		<tr>
    		  <td> <?=$row++?> </td>
      		<td> <?=$key?> </td>
      		<td> <?=$value ?></td>
    		</tr>
    		<?php } ?>
  		</tbody>
		</table>
    </div>
  </div>
</div>

