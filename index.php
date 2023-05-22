<!DOCTYPE HTML>
<html>
    <head lang="en-HR">
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="author" content="Martina Marić">
      <link rel="stylesheet" href="styles/styles.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
      <link rel="icon" type="image/x-icon" href="images/favicon.ico">
      <title>MarsFeed</title>
    </head>

    <body>
        <!--header za stranicu-->
        <div class="header">
            <!--Logo-->
            <div>
                <img src="images/logo.png" id="first_picture">
                <h1>MarsFeed</h1>
            </div>

            <div class="search-container">
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <!--Korisnikov profil-->
            <div>
                <h3>
                    <a href="#">Laura James</a>
                </h3>
                <img src="images/avatar.png" class="second_picture">
            </div>
        </div>

        <!--navigational meni za stranicu-->
        <div class="nav">
            <a href="#">Home</a>
            <a href="#">Info</a>
            <a href="#">Profile</a>
            <a href="#">Contact</a>
        </div>

        <!--content stranice-->
        <div class="row">
            <div class="side">
                <h2>About Me</h2>
                <h5>Photo of me:</h5>
                <div class="img_me"><img src="images/profile_photo.jpg"></div>
                <p>
                  Hello there! &#128522;<br>
                  My name is Laura James (25) and I am super into space.&#128640;<br>
                  I just love looking at the stars and thinking that the universe is<br> so large and we are so little compared to it.<br>
                  Anyhow, I love this page! &#128150;
                </p>
                <br>
                <h3>Picture Album</h3>
                <p>Here are some of my pictures!.</p>
                <div class="slideshow-container">
                  <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="images/nightsky_city.jpg" style="width:100%">
                    <div class="text">This is me, enjoying my time outdoors.</div>
                  </div>
              
                  <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="images/nightsky_park.jpg" style="width:100%">
                    <div class="text">This is also me, enjoying my time in the park.</div>
                  </div>
              
                  <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="images/friendship.jpg" style="width:100%">
                    <div class="text">&#128150;&#128150;&#128150;&#128150;</div>
                  </div>
              
                  <a class="prev" onclick="plusSlides(-1)">❮</a>
                  <a class="next" onclick="plusSlides(1)">❯</a>
                </div>
                
                <br>
                
                <div style="text-align:center">
                  <span class="dot" onclick="currentSlide(1)"></span> 
                  <span class="dot" onclick="currentSlide(2)"></span> 
                  <span class="dot" onclick="currentSlide(3)"></span> 
                </div>

            </div>

            <div class="main">
              <!--Post box-->
              <div class="widget-post" aria-labelledby="post-header-title">
                  
                  <div id="widget-form" class="widget-post-form" name="form" aria-label="post widget">
                    <div class="widget-post-header">
                        <h2 class="widget-post-title" id="post-header-title">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <input id="post-title" type="text" placeholder="Enter title here." class="widget-post-textarea"></input>
                        </h2>
                    </div>
                    <div class="widget-post-content">
                      <label for="post-content" class="sr-only">Share</label>
                      <textarea name="post" id="post-content" class="widget-post-textarea scroller" placeholder="Post text or description for an image here."></textarea>
                    </div>
                    <div class="widget-post-options is-hidden" id="stock-options">
                    </div>
                    <div class="widget-post-actions post-actions">
                      <div class="post-actions-attachments">
                        <button type="button" class="btn post-actions-upload attachments-btn">
                          <label for="upload-image" class="post-actions-label">
                              <i class="fa fa-upload" aria-hidden="true"></i> 
                            upload image
                          </label>
                        </button>
                        <input type="file" id="upload-image" accept="image/*">
                        <span id="upload-image-name"></span>
                      </div>
                      <div class="post-actions-widget">
                        <button id="post-publish" class="btn post-actions-publish">publish</button>
                      </div>
                    </div>
                </div>
              </div>
              <br>
              <hr>
              <?php 
                require_once("php/posts.php");
                 echo(generatePostsHtml());
              ?>
            </div>
        </div>

        <div class="footer">
            <p>Copyright Martina Marić @FESB 2023 PZI-MarsFeed</p>
        </div>

      <script src="scripts/scripts.js"></script>
      <script src="scripts/posts.js"></script>
      <script src="scripts/comments.js"></script>
    </body>
    
</html>