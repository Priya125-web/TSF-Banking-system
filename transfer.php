<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if ($amount > $sql1['balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {

        // deducting amount from sender's account
        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$from";
        mysqli_query($conn, $sql);


        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE users set balance=$newbalance where id=$to";
        mysqli_query($conn, $sql);

        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Hurray! Transaction is Successful');
                                     window.location='transactions.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Money Transfer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <style type="text/css">
        

        * {
            padding: 0;
            margin: 0;
        }

        body {
            width: 100%;
            height: 100vh;
            background-image:linear-gradient(rgba(0,0,0.75,0.6),rgba(0,0,0.75,0.6)),url(images/bank.jpg);
            background-repeat: no-repeat;
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
<div class="container">
    
    <?php
    include 'config.php';
    $sid = $_GET['id'];
    $sql = "SELECT * FROM  users where id=$sid";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    }
    $rows = mysqli_fetch_assoc($result);
    ?>
    <form method="post" name="tcredit" class="tabletext"><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr style="color : white;">
                    <th class="text-center">A/C no.</th>
                    <th class="text-center">Ac holder</th>
                    <th class="text-center">E-Mail</th>
                    <th class="text-center">Ac Balane(in Rs.)</th>
                </tr>
                <tr style="color : white;">
                    <td class="py-2"><?php echo $rows['id'] ?></td>
                    <td class="py-2"><?php echo $rows['name'] ?></td>
                    <td class="py-2"><?php echo $rows['email'] ?></td>
                    <td class="py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : white;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose account</option>
            <?php
            include 'config.php';
            $sid = $_GET['id'];
            $sql = "SELECT * FROM users where id!=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error " . $sql . "<br>" . mysqli_error($conn);
            }
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id']; ?>">

                    <?php echo $rows['name']; ?> (Balance:
                    <?php echo $rows['balance']; ?> )

                </option>
            <?php
            }
            ?>
            <div>
        </select>
        <br>
       
        <label style="color : white;"><b>Amount:</b></label>
        <input type="number" class="form-control" name="amount" required>
        <br><br>
        <div class="text-center" >
            <button class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer Money</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>