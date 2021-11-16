<?php require_once('includes/constants.php'); ?>

<head>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
    <link rel="stylesheet" href="styles/review.css">
    <title>Online Market</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3050/3050209.png" type="image/png">
</head>

<body>
    <script src="scripts/unload.js"></script>   
    <?php include('includes/header.php'); ?>

    <div class="container">
        <div style="padding-top:50px"> </div>
        <main>
          <?php
            mysqli_query($conn, "DELETE FROM comment WHERE submissionDate < CURDATE() - INTERVAL 6 MONTH");

            $result = mysqli_query($conn,"SELECT * FROM comment");

            while($row = mysqli_fetch_array($result))
              {
                $view = $row['feedback'];
                $name = $row['name'];
                $comments = $row['suggestions'];
          ?>
            <div class="reviews-container">
                <!--CONTAINER OF REVIEWER---------------------------->
                <div class="round-container-reviews">
                    <!--NAME OF REVIEWER----------------------------->
                    <div class="reviewerName"> <?php echo $name; ?></div>
                    <!--RATING OF REVIEWER--------------------------->
                    <div class="reviewerRate"> <?php echo $view; ?></div>
                    <!--COMMENT OF REVIEWER-------------------------->
                    <div class="reviewerComment"> <?php echo $comments; ?></div>
                </div>
                <?php
                }
                ?>
                <div class="reviws-padding"></div>
            </div>

            <div class="submission-box-container">
                <form action="includes/comment.php" method="post" class="form-container">
                    <p class="comment-heading">How's the product?</p><br>
                    <div class="rating">
                        <div class="cotainerbox">
                            <label class="container-rating">
                                <input type="radio" name="view" value="excellent" id="excellent" required >
                                <span class="checkmark">Excellent</span>
                            </label>
                        </div>
                        <div class="cotainerbox">
                            <label class="container-rating">
                                <input type="radio" name="view" value="good" id="good" required >
                                <span class="checkmark">Good</span>
                            </label>
                        </div>
                        <div class="cotainerbox">
                            <label class="container-rating">
                                <input type="radio" name="view" value="neutral" id="neutral" required >
                                <span class="checkmark">Neutral</span>
                            </label>
                        </div>
                        <div class="cotainerbox">
                            <label class="container-rating">
                                <input type="radio" name="view" value="poor" id="poor" required >
                                <span class="checkmark">Poor</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="col-25">Name</label>
                        <input type="text" class="col-75" id= "userName" name="name">
                    </div>
                    <div class="row">
                        <label for="" class="col-25">Comment</label>
                        <textarea name="comments" style="height:50px"> </textarea>
                    </div>
                    <div class="comment-btn">
                        <input type="submit" class="submitBtn" value="Enter">
                    </div>
                </form>
            </div>
        </main>
        <footer>Online Marketplace</footer>
    </div>
</body>