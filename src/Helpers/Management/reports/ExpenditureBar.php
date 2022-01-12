<!DOCTYPE html>
<html lang="en">
<head>
  <title>GENERATE BAR EXPENDITURE REPORT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

<div class="jumbotron text-center">
  <h1>LAKDERANA GENERATE BAR EXPENDITURE REPORT</h1>
</div>
  
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <?php
         require_once '../../../Models/Database.inc.php';
         $conn = new Database();
         $db = $conn->db();
        
        require_once '../../vendor/autoload.php';
        
        $from = $_POST['fromDate'];
        $to = $_POST['toDate'];

        $query = "SELECT * FROM bar_expenditure WHERE date >= '".$from."' AND date <= '".$to."'  ";

        $result = mysqli_query($db, $query); 

        $output = "";

  $output .="<br><br><h3 style='color: grey; text-align:center;'>Lakderana Bar Expenditure Report</h3><br>";
  $output .="<h5 style='color: grey; text-align:left;'>Date From : $from Date To : $to </h5>";     
 $output .="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'>
                <tr>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>ID</th>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>Bar ID</th>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>Date</th>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>Item Name</th>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>Item Price</th>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>Quentity</th>
                  <th style='border: 1px solid #ddd;padding: 8px;padding-top: 12px;padding-bottom: 12px;text-align: left;background-color: #fb9640; color: white;'>Total</th>
                </tr>";
        
      if (mysqli_num_rows($result) > 0) { 
              $total = 0;
              $total_items = 0;
      while ($row = mysqli_fetch_assoc($result)) {
          $total = $total + $row['total'];
          $total_items = $total_items + $row['qty'];                      
      
      $output.='
                  <tr>
                    <td  style="border: 1px solid #ddd;padding: 8px;"> '.$row['id'].' </td>
                    <td style="border: 1px solid #ddd;padding: 8px;"> '.$row['bar_id'].' </td>
                    <td style="border: 1px solid #ddd;padding: 8px;"> '.$row['date'].' </td>
                    <td style="border: 1px solid #ddd;padding: 8px;"> '.$row['item'].' </td>
                    <td style="border: 1px solid #ddd;padding: 8px;"> '.$row['amount'].' </td>
                    <td style="border: 1px solid #ddd;padding: 8px;"> x '.$row['qty'].' </td>
                    <td style="border: 1px solid #ddd;padding: 8px;">Rs. '.number_format($row['total'], 2).' </td>
                  </tr>
                ';

             
            }
      $output .= '  <tr>
                    <td  style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="border: 1px solid #ddd;padding: 8px;"><b>Total Items</b></td>
                    <td style="border: 1px solid #ddd;padding: 8px;"><b> '.number_format($total_items, 0).' </b></td>
                  </tr>';
      $output .= '  <tr>
                    <td  style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="padding: 8px;"></td>
                    <td style="border: 1px solid #ddd;padding: 8px;"><b>Total Expenditure</b></td>
                    <td style="border: 1px solid #ddd;padding: 8px;"><b>Rs. '.number_format($total, 2).' </b></td>
                  </tr>';
                  $output .="</table>";

                  $output .="<br><br><h5 style='color: grey; text-align:center;'>Lakderana Management System</h5>";
                  $mpdf = new \Mpdf\Mpdf();
                  $mpdf->WriteHTML($output);
                  $current_date = new DateTime(null, new DateTimeZone('Asia/Colombo'));
                  $current_date = $current_date->format("Y-m-d");
                  $fileName = rand().'_Bar_Expenditure_Report_'.$current_date.'.pdf';
                  $mpdf->Output($fileName, 'D');
        }else{
            $output = "No record found";
            echo "Sorry No Records Found!!";
            echo '<a href="../barExpenditureReport.php" > Go Back </a>';
        } 
      
        

      

     
      ?>
    </div>
  </div>
</div>


</body>

</html>