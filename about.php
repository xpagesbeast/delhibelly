<?php # Script 3.4 - index.php
include('includes/session.php');
highLightNavigationTab('about');

$page_title = 'Delhibelly - about us!';
include('./includes/header.php');
?>
<div class="container">
    <h1>About Us - Meet Group 6</h1>
    <div class="row">
        <div class="col-xs-12">
            <p class="well">The team consisted of three students during the Spring 2018 semester at Northeastern
                Illinois University. The course is CS 319 instructed by professor Diego Fernandez</p>
        </div>
    </div>
    <div class="row about-card">
        <div class="col-sm-2">
            <strong>Slobodan Lohja</strong>
        </div>
        <div class="col-sm-4">
            <p>
                <a title="https://www.linkedin.com/in/slobodanlohja/" href="https://www.linkedin.com/in/slobodanlohja/"
                   target="_blank"><i class="fab fa-linkedin" style="font-size: 48px;"></i></a>
                <a href="https://twitter.com/xpagesbeast" target="_blank"><i class="fab fa-twitter-square"
                                                                             style="font-size: 48px;"></i></a>
                <a href="https://www.facebook.com/slobodan.lohja" target="_blank"><i class="fab fa-facebook-square"
                                                                                     style="font-size: 48px;"></i></a>
                <a href="https://github.com/xpagesbeast/delhibelly" target="_blank"><i class="fab fa-github-square"
                                                                                       style="font-size: 48px;"></i></a>


            </p>
        </div>
        <div class="col-sm-6">Site User Interface design, User Experience, Online Reservations, My Orders, Integrations and Refactoring, Testing and Quality Assurance</div>
    </div>
    <div class="row about-card">
        <div class="col-sm-2">
            <strong>Cesar Mojarro</strong>
        </div>
        <div class="col-sm-4">
            <p>
                <a title="https://www.linkedin.com/in/slobodanlohja/" href="https://www.linkedin.com/in/slobodanlohja/"
                   target="_blank"><i class="fab fa-linkedin" style="font-size: 48px;"></i></a>
                <a href="https://twitter.com/xpagesbeast" target="_blank"><i class="fab fa-twitter-square"
                                                                             style="font-size: 48px;"></i></a>
            </p>
        </div>
        <div class="col-sm-6">Images, Shopping cart</div>
    </div>
    <div class="row about-card">
        <div class="col-sm-2">
            <strong>Sweta Navadia</strong>
        </div>
        <div class="col-sm-4">
            <p>
                <a title="https://www.linkedin.com/in/sweta-navadia/" href="https://www.linkedin.com/in/sweta-navadia/"
                   target="_blank"><i class="fab fa-linkedin" style="font-size: 48px;"></i></a>
                <a href="https://twitter.com/xpagesbeast" target="_blank"><i class="fab fa-twitter-square"
                                                                             style="font-size: 48px;"></i></a>
            </p>
        </div>
        <div class="col-sm-6">Images, My Orders, Testing and Quality Assurance</div>
    </div>

    <div class="row">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item"
                    src="https://docs.google.com/presentation/d/e/2PACX-1vSL7fW2veVxqgeG2Nf5cng8N4jKPyX_nWAuM5nzdtCyhjBBq0V216mWf5ySkcmzFSPm-HD9_dSKEUrB/embed?start=false&loop=false&delayms=3000"
                    frameborder="0" allowfullscreen="true" mozallowfullscreen="true"
                    webkitallowfullscreen="true"></iframe>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10">
            <p style="min-height:60px;">

            </p>
        </div>
    </div>


</div>
<?php

// Call the function again:
//create_ad();

include('includes/footer.html');
?>
<script>

    highlightNavItem('nav-item', 'nav-about');


</script>
</body>
</html>
