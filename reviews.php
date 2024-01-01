<?php
include 'templates/ownerdashboardheader.php';
include 'templates/ownersidebar.php';
include('config/db_connect.php');
session_start();
$user_id=$_SESSION['id'];

$sql = "SELECT rating, feedback FROM rating WHERE user_id = $user_id";
$result = $conn->query($sql);


$avatarImages = array('avatar1.jpg', 'avatar2.png', 'avatar3.png', 'avatar4.png', 'avatar5.png');

?>


<section class="section blog" id="blog" style="margin-left: 10%;margin-top: 5%;">
    <div class="container">
        <h2 class="h2 section-title">Feedbacks</h2>
        <div class="blog-list-grid">

            <?php
            if ($result->num_rows > 0) {
                $avatarCount = count($avatarImages);
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $avatarIndex = $i % $avatarCount; // Cycle through avatars
                    $avatarSrc = 'img/' . $avatarImages[$avatarIndex];
            ?>
                    <div class="blog-card">
                        <figure class="card-banner">
                            <a href="#">
                                <img src="<?php echo $avatarSrc; ?>" alt="Avatar" loading="lazy" class="w-100">
                            </a>
                        </figure>
                        <div class="card-content">
                            <h3 class="h3 card-title">
                                <?php echo $row['feedback']; ?>
                            </h3>
                            <div class="card-meta">
                                <div class="publish-date">
                                    <?php
                                    $rating = $row['rating'];
                                    // Limit the rating to 5 stars
                                    $rating = ($rating > 5) ? 5 : $rating;
                                    // Display stars based on the rating value
                                    for ($j = 1; $j <= 5; $j++) {
                                        if ($j <= $rating) {
                                            echo '<span class="fa fa-star checked"></span>';
                                        } else {
                                            echo '<span class="fa fa-star"></span>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                    $i++;
                }
            } else {
                echo "No feedback available.";
            }
            ?>

        </div>
    </div>
</section>

<style>
    .blog-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        list-style-type: none;
        padding: 0;
    }

    .blog-card {
        border: 1px solid #ccc;
        padding: 20px;
        background-color: #f9f9f9;
    }

    .fa-star {
        color: #ccc;
        font-size: 20px;
    }

    .checked {
        color: orange;
    }

    /* Add additional styles as needed */
</style>
