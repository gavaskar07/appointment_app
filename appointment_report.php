<?php 
include('config.php');
include('header.php');
?>
<h1 class="h3 mb-4 text-gray-800">Appointment Details</h1>
<div class="container">
<form method="post" >
  <!-- start of updataion of the form field and database fields-->
                  
  <table class="table table-striped table-bordered table-hover">
  <tr>
  <td align="right"><b>From Date</b></td>
  <td>
   <input type="date" name="fdate" id="fdate" class="form-control" value="" placeholder="Name"  autofocus="autofocus">
  </td>
  <td align="right"><b>To Date</b></td>
  <td>
   <input type="date" name="tdate" id="tdate" class="form-control" value="" placeholder="Name"  autofocus="autofocus">
  </td>
  </tr>
  <tr>
  <tr>
  <td colspan='2' align="right"><b> Mobile No<b></td>
  <td colspan='2'>
   <input type="text" align='left' name="mobileno" class="form-control" value="" >
   </td>
  </tr>
<td colspan='4' align='center'><button type="submit" class="btn btn-success" name="report" >Submit</button></td>
</tr>
</table>
          <table  id="example2" class="table table-bordered table-hover">
          <tr>
           <td colspan="6" align="right">
            <input type="button" id="btnExport" value="Download As PDF" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#example1')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("userdetail.pdf");
                }
            });
        });
    </script>
          </td>
          </tr>
          </table>
		  <table  id="example1" class="table table-bordered table-hover">
			<thead>
			  <tr>
<!-- start of table header change-->
			<th>Appointment Date</th>
			<th>Person Name</th>
			<th>Mobile No</th>
			<th>Place</th>
      <!-- End of table header change-->
			  </tr>
			</thead>
			<tbody>
			<?php
       //start of typing  query
       if(isset($_REQUEST['report'])){
        $fdate=$_REQUEST['fdate'];
        $tdate=$_REQUEST['tdate'];
        $mobileno=$_REQUEST['mobileno'];
        if($_REQUEST['mobileno']=="")
        {
          $query  = "select * from appointment where adate>='$fdate' and adate<='$tdate' order by pname  ";
        }
       else{
        $query  = "select * from appointment where mobileno  LIKE '%$mobileno%' order by adate  ";
       }
      // echo $query;
      }
        else{
        $query  = "select * from appointment order by pname";
       }
		//echo $query;
    //En of typing  query
$result = mysqli_query($conn,$query);
  while($data = mysqli_fetch_assoc($result))
		{
			?>
			  <tr>
          <!-- start of Changing database variable-->
			  <td><?php echo $data["adate"]; ?></td>
			<td><?php echo $data["pname"]; ?></td>
			<td><?php echo $data["mobileno"]; ?></td>
			<td><?php echo $data["place"]; ?></td>    
      <!-- end of Changing database variable-->
			  </tr>
			  <?php 	
		}
		?>
			</tbody>
		  </table>
  </form>
</div>
<?php
include('footer.php');
?>