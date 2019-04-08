<!DOCTYPE html>
<html>
<!-- 
		Author: Alejandro González
		Auckland University of Technology
	-->

<head>
    <meta http-equiv="content_type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap + Custom-->
    <link rel="stylesheet" href="./css/custom.css" />
    <script src="./js/main.js"></script>
    <title>Post Status</title>
</head>

<body>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "invalidstatuscode") {
            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
						<strong>Wowowowow !</strong>  Hold it right there hacker! Status Code must look something like this: S0001.
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\">&times;</span>
						</button>
					</div>";
        } else if ($_GET['error'] == "statuscodealreadyexists") {
            echo "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
						<strong>Sorry! </strong> That Status Code is already taken.
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
						<span aria-hidden=\"true\">&times;</span>
						</button>
					</div>";
        }
    }
    ?>
    <!--Form to Generate Status-->
    <form class="needs-validation" action="poststatusprocess.php" method="post">
        <!-- Status Unique ID and Status Message-->
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label for="formGroupExampleInput">Status Code</label>
                    <input type="text" name="sCode" class="form-control" id="formGroupExampleInput" required />
                </div>
                <div class="col-2">
                    <label for="formGroupExampleInput0">Date</label>
                    <input type="date" name="sDate" class="form-control" id="formGroupExampleInput0" required />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Status</label>
            <input autofocus type="text" name="status" class="form-control" id="formGroupExampleInput2" placeholder="Don't forget to #hashtag it!" required />
        </div>
        <!-- Status Unique ID and Message End-->

        <!-- Checkboxes for Permissions-->
        <p>Public Permissions:</p>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1" name="spLike" />
            <label class="custom-control-label" for="customCheck1">Like</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck2" name="spComment" />
            <label class="custom-control-label" for="customCheck2">Comment</label>
        </div>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck3" name="spShare" />
            <label class="custom-control-label" for="customCheck3">Share</label>
        </div>
        <!-- Checkboxes for Permissions End-->

        <!-- Preferred audience-->
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                <select class="custom-select mr-sm-2" name="audience" id="inlineFormCustomSelect">
                    <option value="Public" selected>Public</option>
                    <option value="Friends">Friends</option>
                    <option value="Only me">Only Me</option>
                </select>
            </div>
            <!-- Preferred audience End-->

            <!-- Reset Button to empty all Fields-->
            <div class="col-auto my-1">
                <button type="reset" class="btn btn-outline-danger shadow-sm px-md-5">
                    Reset
                </button>
                <!-- Submit everything to PHP form-->
                <button id="submitButton" name="post-submit" type="submit" class="btn btn-outline-primary shadow-sm  px-md-5">
                    Submit
                </button>
            </div>
            <!-- Buttons End-->
        </div>
    </form>
    <!-- Form to Generate Status End-->

    <a class="btn btn-outline-dark btn-custom shadow-sm px-md-5" href="./index.html" role="button">Back to Home</a>


    <!-- Pre-set the date field to yesterday-->
    <script>
        document.querySelector(
            "#formGroupExampleInput0"
        ).valueAsDate = new Date();
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>