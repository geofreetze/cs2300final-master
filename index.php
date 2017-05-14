<?php
    session_start();
?>
<!doctype html>
<html lang = "en">
    <head>
        <title>Over the Wall Whiskey</title>
        <!--metadata-->
        <meta name="description" content="Over The Wall Whiskey - heirloom non-GMO corn whiskey produced sustainably utilizing Mexican heirloom landrace corn sourced from smallholder farmers.">
        <meta name="keywords" content="over the wall whiskey mexican non-gmo corn gmo heirloom corn landrace sustainable">
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name = "apple-mobile-web-app-title" content="Over the Wall">
        
        <meta property="og:type" content="business.business">
        <meta property="og:title" content="Over The Wall Whiskey">
        <meta property="og:url" content="overthewallwhiskey.com">
        <meta property="og:image" content="">
        <meta property="business:contact_data:street_address" content="">
        <meta property="business:contact_data:locality" content="">
        <meta property="business:contact_data:region" content="New York">
        <meta property="business:contact_data:postal_code" content="">
        <meta property="business:contact_data:country_name" content="United States">
        
        <link rel = "icon" type = "image/x-icon" href = "./favicon.ico">
        <link rel = "apple-touch-icon" sizes = "180x180" href = "./icon/apple-icon-180x180.png">
        <link rel = "apple-touch-icon" sizes = "152x152" href = "./icon/apple-icon-152x152.png">
        <link rel = "apple-touch-icon" sizes = "76x76" href = "./icon/apple-icon-76x76.png">
        
        <link rel = "stylesheet" href = "./bootstrap/bootstrap.min.css">
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
        
        <link rel = "stylesheet" href = "./font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel = "stylesheet" href = "./css/stylesheet.css">
        
        <script src = "./js/jquery-3.2.1.min.js"></script>
        <script src = "./js/script.js"></script>
        <script src = "./js/bday.js"></script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBkvbJdQpUUjHwqyFeyvaSEP9lvuKDKfU&callback=initMap">
        </script>
        <script src="./js/map.js">
            //Because I have to import async defer this should only work onload
            window.onload = function() {
                google.maps.event.addDomListener(window, 'load', initMap);
            };
        </script>
    </head>
    <body>
        <?php
            // check if form was submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { //http://stackoverflow.com/questions/7711466/checking-if-form-has-been-submitted-php
                
                $birthDate = $_POST['bday'];
                
                $day = substr($birthDate, 8, 2);
                $month = substr($birthDate, 5, 2);
                $year = substr($birthDate, 0, 4);

                // validate date input
                if (checkdate($month, $day, $year)) {

                    //http://stackoverflow.com/questions/3776682/php-calculate-age
                    
                    $birthDate = $month . "/" . $day . "/" . $year;
                    $birthDate = explode("/", $birthDate);
                    //get age from date or birthdate
                    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));

                    // if underage then redirect to rehab website, else beer
                    if ($age < 21) {
                        //http://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php/8028979#8028979
                        //echo("<script>location.href = 'https://www.alcoholrehabguide.org/resources/underage-drinking/';</script>");
                    }
                    else {
                        $_SESSION['over21'] = true;
                    }                    
                }
                else {
                    print("You passed an invalid date through html 5's date form");
                }
                
            }
        ?>  

        <?php if (!isset($_SESSION['over21'])) { ?>



            <div id="not_logged_in_yet">
                <form action="index.php" method="post">
                    Birthday:
                    <input id="bday" type="date" name="bday" required>
                    <input type="submit">
                </form>
            </div>



        <?php } else { ?>



            <div id="logged_in">
                <div class = "topnav">
                    <a class = "icon" id = "open-sidenav"><i class="fa fa-bars" aria-hidden="true"></i></a>
                </div>
                <div id = "sidenav" class = "sidenav">
                    <a class = "icon" id = "close-sidenav"><i class = "fa fa-times" aria-hidden="true"></i></a>
                    <a href = "#top" class = "logo-image-container"><img src = "img/whitesquare.png" class = "logo-image" alt = "Over the Wall Whiskey"/></a>
                    <a href = "#top">Home</a>
                    <a href = "#products">Whiskeys</a>
                    <a href = "#about">The Story</a>
                    <a href = "#social">Follow Us</a>
                    <a href = "#locator">Locations</a>
                    <span class = "social-links">
                        <a href = "https://www.facebook.com/overthewallwhiskey/" target = "_blank"><i class = "fa fa-facebook-official"></i></a>
                        <a href = "https://www.instagram.com/overthewallwhiskey/" target = "_blank"><i class = "fa fa-instagram"></i></a>
                    </span>
                </div>
                        
                <div class = "container-fluid content">
                    
                    <!-- Top Section -->
                    <section id = "top">
                        <div class = "row">
                            <div class = "col-md-12 section-wrapper">
                                <div class = "jumbotron">
                                    <div class = "jumbotron-text">Thousands of years in the making. Smell, sip, and enjoy.</div>
                                </div>
                            </div>
                            <h1>Validate Title</h1>
                        </div>
                    </section>
                    
                    <!--Products Section-->
                    <section id = "products">
                        <div class = "row">
                            <div class = "section-header" id = "whiskeys">
                                <div class = "section-title">Whiskeys</div>
                            </div>
                        </div>
                        
                        <div class = "row">
                            <div class = "col-md-12">
                                <h1 class = "product-header">Crafted from hand-selected Mexican heirloom corn, GMO and gluten-free. </h1>
                            </div>
                        </div>
                        
                        <!-- This section should be replaced by database later -->
                        <div class = "row">
                            <div class = "col-md-6 section-wrapper product-wrapper">
                                <div class = "product-container">
                                    <img class = "product-image" src = "img/whiskey.jpg" alt = "product placeholder">
                                </div>
                            </div>
                            <div class = "col-md-6 section-wrapper product-wrapper">
                                <div class = "product-info">
                                    <h1 class = "product-title">Non-GMO Straight Corn Whiskey</h1>
                                    <p class = "product-description">This is a description of the product. More information will be provided by the client as the company further develops.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class = "row">
                            <div class = "col-md-6 section-wrapper product-wrapper">
                                <div class = "product-container">
                                    <img class = "product-image" src = "img/whiskey.jpg" alt = "product placeholder">
                                </div>
                            </div>
                            <div class = "col-md-6 section-wrapper product-wrapper">
                                <div class = "product-info">
                                    <h1 class = "product-title">Non-GMO Corn Whiskey</h1>
                                    <p class = "product-description">This is a description of the product. More information will be provided by the client as the company further develops.</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    
                    <!-- About Section -->
                    <section id = "about">
                        <div class = "row">
                            <div class = "section-header" id = "story">
                                <div class = "section-title">The Story</div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class = "col-md-12">
                                
                                <h1 class = "about-title">A new age[d] take on a classic American drink.</h1>
                                <img class = "borderless-img" id = "otwlogo" src = "./img/OTWlogowhite.png" alt = "Over the Wall">
                                <h2 class = "about-subtitle">Founded by 3 college students in Ithaca, N.Y., Over The Wall Whiskey is an heirloom, non-GMO, gluten-free corn whiskey produced sustainably with heirloom landrace corn sourced from smallholder farmers in Mexico.</h2>
                                
                                <h1 class = "about-title">Follow the Corn</h1>
                                <img class = "borderless-img" src = "./img/about/whitecorn.png" alt = "corn logo">
                                <h2 class = "about-subtitle">When we learned of the deep Mexican heritage at the root of farming heirloom corn, we saw a need. Corn, an undervalued but essential whiskey ingredient, was losing its most deserving attributes in the commercializing market. By tapping into this seven thousand-year-old history, we’ve produced a wildly unique flavor profile - 100% corn, non-GMO and gluten-free. No additives. It’s the essence of how whiskey should be. We’ve honed our ingredient selection and manufacturing process to maintain the authenticity this product deserves.
                                </h2>
                                
                                
                                <h1 class = "about-title">Meet the Team</h1>
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col-md-4">
                                <h2 class = "person-name">Brian</h2>
                                <img class = "about-person" src = "./img/about/peopleplaceholder.png" alt = "placeholder">
                                <p class = "person-info">
                                    This is text about a person. A longer description will be provided by the client later.
                                </p>
                            </div>
                            <div class = "col-md-4">
                                <h2 class = "person-name">Zach</h2>
                                <img class = "about-person" src = "./img/about/peopleplaceholder.png" alt = "placeholder">
                                <p class = "person-info">
                                    This is text about a person. A longer description will be provided by the client later. This is a filler sentence provided to test what happens when descriptions are of different lengths.
                                </p>
                            </div>
                            <div class = "col-md-4">
                                <h2 class = "person-name">Turner</h2>
                                <img class = "about-person" src = "./img/about/peopleplaceholder.png" alt = "placeholder">
                                <p class = "person-info">
                                    This is text about a person. A longer description will be provided by the client later.
                                </p>
                            </div>
                        </div>
                        <div class = "row">
                            <div class = "col-md-12">
                                <h1 class = "about-title">The Source</h1>
                                <img class = "about-person" src = "./img/about/masiendawhite.png" alt = "placeholder">
                                <h2 class ="about-subtitle">Founded by Jose Gaviria, Masienda has rediscovered these flavor-focused, high-quality, Latin ingredients and successfully introduced them to the American kitchen. Jose's connection to corn was striking, and his passion  embodied the 7,000 year-old heritage that Mexican farmers devoted to producing high-quality corn. We knew there was something truly unique here. 
                                </h2>
                                
                                <h1 class=  "about-title">Community</h1>
                                <img class = "about-person" src = "./img/hand.png" alt = "placeholder"/>
                                <h2 class = "about-subtitle">10% of all profits from Over the Wall products will go to support further education for our Mexican farming partners and families.</h2>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Social Media -->
                    <section id = "social">
                        <div class = "row">
                            <div class = "section-header" id = "smedia">
                                <div class = "section-title">Follow Over the Wall</div>
                            </div>
                        </div>

                        <div class = "row social-content">
                            <div class = "col-md-4 col-md-offset-2">
                                <div class = "instagram-container">
                                    Instagram post goes here.
                                </div>
                            </div>
                            <div class = "col-md-4">
                                <h1 class = "social-title">Sign up for our Email List</h1>
                                This is a placeholder.
                                <form>
                                    <input type = "text">
                                    <input type = "submit" style = "color: black">
                                </form>
                                <h1 class = "social-title">Find us on Facebook</h1>
                                <div class = "page-container">
                                    Facebook embed goes here.
                                </div>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Locator -->
                    
                    <section id = "locator">
                        <div class = "row">
                            <div class = "section-header" id = "maps">
                                <div class = "section-title">Find Over the Wall</div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class = "col-md-8">
                                <h1>Map</h1>
                                <div id="map"></div>
                            </div>
                            <div class = "col-md-4">
                                <h1>Search Results</h1>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>



        <?php } ?>
    </body>
</html>