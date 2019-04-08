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
        <hr class="my-2" />
        <?php
        #Check if user used the form instead of direct url link
        if (isset($_POST['post-submit'])) {
            require 'dbh.inc.php';

            $_sCode = $_POST['sCode'];
            $_sDate = $_POST['sDate'];
            $_status = $_POST['status'];
            $_spLike = $_POST['spLike'];
            $_spLikeBool = 0;
            $_spComment = $_POST['spComment'];
            $_spCommentBool = 0;
            $_spShare = $_POST['spShare'];
            $_spShareBool = 0;
            $_audience = $_POST['audience'];
            $_sPattern = "/[S]\d{4}$/";

            //Check for valid status code syntax
            if (!preg_match($_sPattern, $_sCode)) {
                header("Location: ./poststatusform.php?error=invalidstatuscode");
                exit();
            }

            $sql = "SELECT CharID FROM posts WHERE CharID=?";
            $sqlString = "CREATE TABLE posts (
                CharID VARCHAR(10) NOT NULL,
                sdate DATE,
                statusmessage VARCHAR(200) NOT NULL,
                splike BIT NOT NULL,
                spcomment BIT NOT NULL,
                spshare BIT NOT NUll,
                audience VARCHAR(10) NOT NULL,
                PRIMARY KEY (CharID)
            )";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $queryResult = mysqli_query($conn, $sqlString)
                    or die("<p>Unable to execute the query.</p>"
                        . "<p>Error code " . mysqli_errno($conn)
                        . ": " . mysqli_error($conn)) . "</p>";
                echo "<p>Successfully created the table.</p>";

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ./poststatusform.php?error=sqlerror");
                    exit();
                }
            } else {
                mysqli_stmt_bind_param($stmt, "s", $_sCode);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);

                if ($resultCheck > 0) {
                    header("Location: ./poststatusform.php?error=statuscodealreadyexists");
                    exit();
                } else {
                    $sql = "INSERT INTO posts (CharID, sDate, statusmessage, splike, spcomment, spshare, audience ) VALUES (?, ?, ?, ?, ?, ?, ? )";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ./poststatusform.php?error=sqlerror");
                        exit();
                    } else {
                        if ($_spLike != "") {
                            $_spLikeBool = 1;
                        }
                        if ($_spComment != "") {
                            $_spCommentBool = 1;
                        }
                        if ($_spShare != "") {
                            $_spShareBool = 1;
                        }
                        mysqli_stmt_bind_param($stmt, "sssiiis", $_sCode, $_sDate, $_status, $_spLikeBool, $_spCommentBool, $_spShareBool, $_audience);
                        mysqli_stmt_execute($stmt);
                        echo "<p>Status Code: ", $_sCode, "</p>";
                        echo "<p>Status: ", $_status, "</p>";

                        echo "<br>";

                        echo "<p>Audience: ", $_audience, "</p>";
                        #Conditions for Permissions
                        echo "<p>Permissions: ";
                        if (isset($_POST['spLike'])) {
                            echo "Likes ";
                        }
                        if (isset($_POST['spComment'])) {
                            echo "Comments ";
                        }
                        if (isset($_POST['spShare'])) {
                            echo "Shares ";
                        }
                        if (!isset($_POST['spLike']) && !isset($_POST['spComment']) && !isset($_POST['spShare'])) {
                            echo "None ";
                        }
                        echo "</p>";

                        $newDate = date("d-m-Y", strtotime($_sDate));
                        echo "<p>Date Posted: ", $newDate, "</p>";
                        echo "<a class=\"btn btn-secondary btn-custom shadow-sm px-md-5\" href=\"./poststatusform.php\" role=\"button\">Post Again</a>";
                        exit();
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            header("Location: ./poststatusform.php");
            exit();
        }
        ?>

    </div>
    <!-- Navigation Buttons -->
    <a class="btn btn-primary btn-custom shadow-sm px-md-5" href="./poststatusform.php" role="button">Post Again</a>
    <a class="btn btn-outline-dark btn-custom shadow-sm px-md-5" href="./index.html" role="button">Back Home</a>


</body>

</html>