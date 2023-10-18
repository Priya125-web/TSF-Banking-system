<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transfer History</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/table.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <style type="text/css">
    *{
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}

.banner{
    width: 100%;
    height: 130vh;
    background: linear-gradient(rgba(0,0,0.75,0.6),rgba(0,0,0.75,0.6)),url(images/bank.jpg);
    background-size: cover;
    background-position: center;
}

.navbar{
    width: 100%;
    margin: auto;
    padding: 25px 0;
    background: rgba(93, 109, 109, 0.4);
    display: flex;
    align-items: center;
    justify-content: space-between;
    
}

.navbar h1{
    margin-left: 55px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 40px;
    font-weight: 800;
    color: #009688;
}


.navbar ul li{
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    position: relative;
}

.navbar ul li a{
    text-decoration: none;
    padding: 0 10px;
    color: #ffffff;
    text-transform: uppercase;
}

.navbar ul li::after{
    content: '';
    height: 3px;
    width: 0;
    background: #fff;
    position: absolute;
    left: 0;
    bottom: -10px;
    transition: 0.5s;
}
.navbar ul li:hover::after{
    width: 100%;
}
.h-btn{
    display: inline-flex;
    text-decoration: none;
    margin-right: 25px;
    padding: 11px 26px;
    background: transparent;
    color: #ffffff;
    border: 2px solid #009688;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 700;
    }
.h-btn:hover{
    background: #009688;
    color: #fff;
    text-decoration: none;
}    

    
  </style>
</head>
<div class="banner">
        <div class="navbar">
            <h1>FINTECH</h1>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href=" https://www.thesparksfoundationsingapore.org/">About</a></li>
                <li><a href="./customers.php">Customers</a></li>
                <li><a href="./transactions.php">Transaction</a></li>   
            </ul>

            <div class="top-btnn">
            <a href="#" class="h-btn">Contact us</a>
           
          </div>
        </div>
<div class="container">

  <br>
  <div class="table-responsive-sm">
    <table class="table table-hover table-striped table-condensed table-bordered">
      <thead style="color : white;">
        <tr>
          <th class="text-center">S.No.</th>
          <th class="text-center">Sender</th>
          <th class="text-center">Receiver</th>
          <th class="text-center">Amount</th>
          <th class="text-center">Date & Time</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include 'config.php';

        $sql = "select * from transaction";

        $query = mysqli_query($conn, $sql);

        while ($rows = mysqli_fetch_assoc($query)) {
        ?>

          <tr style="color : white;">
            <td class="py-2"><?php echo $rows['sno']; ?></td>
            <td class="py-2"><?php echo $rows['sender']; ?></td>
            <td class="py-2"><?php echo $rows['receiver']; ?></td>
            <td class="py-2"><?php echo $rows['balance']; ?> </td>
            <td class="py-2"><?php echo $rows['datetime']; ?> </td>

          <?php
        }

          ?>
      </tbody>
    </table>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>