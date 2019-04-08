<!DOCTYPE html>
<html lang="en">
<!-- 
        Author: Alejandro González
        Auckland University of Technology
    -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap + Custom-->
    <link rel="stylesheet" href="./css/custom.css" />

    <title>As1 - About</title>
</head>

<body>
    <div class="jumbotron clearfix">
        <h1 class="display-4">Status Information</h1>

        <?php
        #Check if user used the form instead of direct url link
        if (isset($_GET['search-submit'])) {
            require 'dbh.inc.php';
            $_keyString = $_GET['keyString'];
            $sqlString = "SELECT CharID, sdate, statusmessage, splike, spcomment, spshare, audience FROM posts WHERE statusmessage LIKE '%$_keyString%' OR CharID LIKE '$_keyString' ";
            $quetyResult = mysqli_query($conn, $sqlString);
            $row = mysqli_fetch_row($quetyResult);

            #Check if a row has been retrieved
            if ($row[0] == null) {
                echo "<hr class=\"my-2\" />";
                echo "<p> Not Found. </p>";
                echo "<p> This may be due to two reasons: <br> - \"{$_keyString}\" does not match any existing Status Code. <br> - No Status Message contains the entered input. </p>";
            }
            while ($row) {
                echo "<hr class=\"my-2\" />";
                echo "<p>Status Code: {$row[0]}</p>";
                echo "<p>Status: {$row[2]}</p>";
                echo "<br>";
                echo "<p>Audience: {$row[6]}</p>";
                #Conditions for Permissions
                echo "<p>Permissions: ";
                #Check for true or false
                if ($row[3] == 1) {
                    echo "Likes ";
                }
                if ($row[4] == 1) {
                    echo "Comments ";
                }
                if ($row[5] == 1) {
                    echo "Shares ";
                }
                if ($row[3] == 0 && $row[4] == 0 && $row[5] == 0) {
                    echo "None ";
                }

                echo "</p>";
                echo "<p>Date Posted: {$row[1]}</p>";
                #Next value
                $row = mysqli_fetch_row($quetyResult);
            }
            mysqli_close($conn);
        } else {
            header("Location: ./searchstatusform.html");
            exit();
        }
        ?>
    </div>
    <!-- Navigation Buttons -->
    <a class="btn btn-secondary btn-custom shadow-sm px-md-5" href="./searchstatusform.html" role="button">Search Again</a>
    <a class="btn btn-outline-dark btn-custom shadow-sm px-md-5" href="./index.html" role="button">Back Home</a>
</body>

</html>