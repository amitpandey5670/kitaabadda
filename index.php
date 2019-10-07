<?php
   session_start();
   if(isset($_SESSION['admin'])){
    session_destroy();
   } 

?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <title>KitaabAdda</title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/v4-shims.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <header class="header" >
        
        <div class="your-element" data-tilt data-tilt-max="40" data-tilt-transition="true"><img class="logo" src="Images/Icon.png"></div>

        <div id="searchBox" style="width: 15%;">
            <input id="locationButton" type="text" name="city" placeholder="Enter City" style="margin-top: 0.5rem;">
            <button type="button" id="searchButton" class="locationButton" role="button" tabindex="0">
                <span id="searchIcon"><i class="fas fa-search"></i></span>
            </button>
        </div>
            

        <div id="searchBox">
            <input id="search" type="text" name="search" placeholder="Enter Book,Author,Publication.....">
            <div id="searchloader" style="display: none;">
                
            </div>
            <button type="button" id="searchButton" role="button" tabindex="0">
                <span id="searchIcon"><i class="fas fa-search"></i></span>
            </button>
        </div>
        <div id="loginBox">
            <button type="button" id="loginButton">
                <span id="login">Login</span>
            </button>

            <button type="button" id="sellButton" role="button" tabindex="0">
                    <span id="sellIcon"><i class="fas fa-camera"></i></span>
                    <span id="sellText">Sell</span>
            </button>
        </div>
        <script>
            $('#loginButton').click(function(){
                location.href = 'login.php';
            });

            $('#sellButton').click(function(){
                location.href = 'login.php';
            });
        </script>

    </header>
                
    <nav id="navbar">
        <div>
                <a class="navButton" href="index.php">Home</a>
                <button class="navButton" id="engineering">Engineering</button>
                <button class="navButton" id="science">Science</button>
                <button class="navButton" id="commerce">Commerce</button>
                <button class="navButton" id="arts">Arts</button>
                <button class="navButton" id="medical">Medical</button>
                <button class="navButton" id="hsc">HSC</button>
                <button class="navButton" id="school">1-10std</button>
                <button class="navButton" id="competitive">Competitive</button>
                <button class="navButton" id="others">Others</button>
        </div>
    </nav>

    <div id="cover">
       <div>
         <img src="Images/cover1.jpg">
       </div>
       <div>
         <img src="Images/cover2.jpg">
       </div>
       <div>
         <img src="Images/cover3.jpg">
       </div>
        
    </div>
    <div class="itemsHeading"></div>



    <div id="items" style="background-color: white;">
    


    </div>
    <div>
        <span id="loadMore" class="loading" style="display: none;">Loading...</span>
        <button type="button" id="loadButton" role="button" tabindex="0">
            <span id="loadMore">Load More</span>
        </button>
    </div>
 

    <footer id="footer">
        <div class="social-menu">
            <ul>
                <li><a href="tel:+919082004479" target="_blank" ><i class="fa fa-phone"></i></a></li>
                <li><a href="https://www.facebook.com/profile.php?id=100004534278375" target="_blank" ><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/Amitkum45372322" target="_blank" ><i class="fa fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/amit_pandey_05/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li><a href="https://www.linkedin.com/in/amit-pandey-6a66ba182/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            </ul>
        </div>
        <div class="foot">&copy; Copyright KitaabAdda 2019</div>

        <?php include("location.php");  ?>
        
    </footer>

    <script type="text/javascript">


    $(document).ready(function(){
          var city = "<?php echo $city;  ?>";
           var search = '';
           var category = 'Others';
           var track_page = 1;
           var loading = false;

           $("#locationButton").keypress(function(e){
                if ($(this).val().length > 0 && e.keyCode === 13) {
                    city = $(this).val();
                    track_page = 1;
                    category = 'Others';
                    $(".itemsHeading").html("All Books");
                    $("#items").empty();
                    loadContent(track_page,category);
                }
            });

           $(".locationButton").click(function(){

            if($("#locationButton").val().length > 0){
                city = $("#locationButton").val();
                track_page = 1;
                category = 'Others';
                $(".itemsHeading").html("All Books");
                $("#items").empty();
                 loadContent(track_page,category);


            }
           });



           $(".itemsHeading").html("All Books");
 
           loadContent(track_page,category);
           $("#loadButton").click(function(){
              track_page ++;
              if(search == ''){
                 loadContent(track_page,category);
              }else{
                loadSearchContent(track_page,category,search);

              }
           });

           $("#search").keypress(function(e){
                if ($(this).val().length > 0 && e.keyCode === 13) {
                     search = $(this).val();
                     track_page = 1;
                     category = 'Others';
                     $(".itemsHeading").html(search);
                     $("#items").empty();
                     loadSearchContent(track_page,category,search);
                }
            });

           $("#searchButton").click(function(){
            if($("#search").val().length > 0){
                search = $("#search").val();
                track_page = 1;
                category = 'Others';
                $(".itemsHeading").html(search);
                $("#items").empty();
                loadSearchContent(track_page,category,search);

            }

           });

            $("#others").click(function(){

                $(".itemsHeading").html("All Books");
                search = '';
                track_page = 1;
                category = 'Others';
                $("#items").empty();

                loadContent(track_page,category);


            });

            $("#engineering").click(function(){
                $(".itemsHeading").html("Engineering Books");
                search = '';
                track_page = 1;
                category = 'Engineering';
                $("#items").empty();

                loadContent(track_page,category);
            });

            $("#science").click(function(){
                $(".itemsHeading").html("Science Books");
                search = '';
                track_page = 1;
                category = 'Science';
                $("#items").empty();

                loadContent(track_page,category);
            });

            $("#commerce").click(function(){
                $(".itemsHeading").html("Commerce Books");
                search = '';
                track_page = 1;
                category = 'Commerce';
                $("#items").empty();

                loadContent(track_page,category);

            });

            $("#medical").click(function(){
                $(".itemsHeading").html("Medical Books");
                search = '';
                track_page = 1;
                category = 'Medical';
                $("#items").empty();

                loadContent(track_page,category);

            });

            $("#arts").click(function(){
                $(".itemsHeading").html("Arts Books");
                search = '';
                track_page = 1;
                category = 'Arts';
                $("#items").empty();

                loadContent(track_page,category);

            });


            $("#hsc").click(function(){
                $(".itemsHeading").html("HSC Books");
                search = '';
                track_page = 1;
                category = 'HSC';
                $("#items").empty();

                loadContent(track_page,category);


            });

            $("#school").click(function(){
                $(".itemsHeading").html("1st to 10th std Books");
                search = '';
                track_page = 1;
                category = '1-10th';
                $("#items").empty();

                loadContent(track_page,category);

            });

            $("#competitive").click(function(){
                $(".itemsHeading").html("Competitive Exam Books");
                search = '';
                track_page = 1;
                category = 'Competitive';
                $("#items").empty();
                loadContent(track_page,category);

            });

            function loadContent(track_page,category){
                console.log(category);
                if(loading == false){
                    loading = true;
                    $('.loading').show();
                    $.post('fetch.php','category='+category+'&city='+city+'&page='+track_page, function(data){
                        loading = false;
                        if(data.trim().length == 0){
                            $('.loading').hide();
                            return;
                        }
                        $("#items").append(data);
                        $('.loading').hide();


                    }).fail(function (xhr,ajaxOptions,thrownError){
                        $('.loading').hide();
                    });
                }
            }

            function loadSearchContent(track_page,category,search){
                console.log(search);
                if(loading == false){
                    loading = true;
                    $('.loading').show();
                    $.post('fetch.php','category='+category+'&city='+city+'&page='+track_page+'&search='+search, function(data){
                        loading = false;
                        if(data.trim().length == 0){
                            $('.loading').hide();
                            return;
                        }
                        $("#items").append(data);
                        $('.loading').hide();


                    }).fail(function (xhr,ajaxOptions,thrownError){
                        $('.loading').hide();
                    });
                }
            }
    });

    </script>
                

<script type="text/javascript" src="vanilla-tilt.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>


