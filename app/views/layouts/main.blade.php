<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>eCommerce</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        {{HTML::style('css/normalize.css')}}
        {{HTML::style('css/main.css')}}
        {{HTML::script('js/vendor/modernizr-2.6.2.min.js')}}
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

       <div id="wrapper"> 
          <header>
                <section id="top-area">
                    <p>Phone orders: 1-8000-0000 | Email us: <a href="mailto:office@shop.com">office@shop.com</a></p>
                    
                </section> 
                <!-- End top-area -->
                <section id="action-bar">
                    <div id="logo">
                        <a href="/"><span id="logo-accent">e</span>Commerce</a>
                    </div> <!-- End Logo --> 
                    <nav class="dropdown">
                        <ul>
                            <li><a href="#">Shop by Category
                            {{HTML::image('img/down-arrow.gif', 'Shop by Category')}} 
                            </a> 
                                <ul>
                                    @foreach($catnav as $cat)
                                        <li>{{HTML::link('/store/category/'.$cat->id, $cat->name)}}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <div id="search-form">
                        {{Form::open(array(
                            'url'=>'/store/search',
                            'method'=>'get'
                            ))}}
                        {{Form::text('keyword', null, array(
                            'placeholder' => 'Search by Keyword',
                            'class' => 'search'
                                    ))}}
                        {{Form::submit('Search', array(
                            'class' => 'search submit'))}}
                        {{Form::close()}}
                    </div> <!-- End searh form -->
                    <div id="user-menu">

                        @if(Auth::check())
                        <nav class="dropdown">
                            <ul>
                                <li><a href="#">{{HTML::image('img/user-icon.gif', Auth::user()->firstname)}}{{Auth::user()->firstname}} {{HTML::image('img/down-arrow.gif', Auth::user()->firstname)}}</a> 
                                    <ul>                               
                                        @if(Auth::user()->admin == 1)
                                            <li>{{HTML::link('admin/categories', 'Manage Categories')}}</li>
                                            <li>{{HTML::link('admin/products', 'Manage Products')}}</li>
                                        @endif 
                                        <li>{{HTML::link('users/signout', 'Sign Out')}}</li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        @else
                            <nav id="signin"class="dropdown">
                                <ul>
                                    <li><a href="#">{{HTML::image('img/user-icon.gif', 'Sign In')}} {{HTML::image('img/down-arrow.gif', 'Sign In')}}</a> 
                                        <ul>
                                            <li>{{HTML::link('users/signin', 'Sign In')}}</li>
                                            <li>{{HTML::link('users/newaccount', 'Sign Up')}}</li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav> 
                        @endif
                         
                    
                    <div id="view-cart"><a href="/store/cart">{{HTML::image('img/blue-cart.gif', 'View Cart')}}View Cart</a>
                    </div> <!-- End view-cart -->
                    </div> <!-- End user-menu -->
                </section> <!-- End action-bar --> 
            </header> 
            @yield('promo')
            @yield('search-keyword')
           <hr />
            <section id="main-content" class="clearfix">
                @if(Session::has('message'))
                <p class="alert">{{Session::get('message')}}</p>
                @endif
                @yield('content')
            </section> <!-- End main-content -->
            
            <hr />
            @yield('pagination')
            <footer>
                <section id="contact">
                    <h3>For phone orders please call 1-800-0000. You<br>can also email us at <a href="mailto:office@shop.com">office@shop.com</a></h3>
                </section><!-- End contact -->
                <hr />
                <section id="links">
                    <div id="my-account">
                        <h4>MY ACCOUNT</h4>
                        <ul>
                        <li>{{HTML::link('users/signin', 'Sign In')}}</li>
                        <li>
                            {{HTML::link('users/newaccount', 'Sign Up')}}
                        </li>                          
                            <li><a href="store/cart">Shopping Cart</a></li>
                        </ul>
                    </div> <!-- End my-accounts -->
                    <div id="info">
                        <h4>INFORMATION</h4>
                        <ul>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>         
                        </ul>
                    </div> <!-- End info -->
                    <div id="extras">
                        <h4>EXTRAS</h4>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li>{{HTML::link('/store/contact', 'Contact Us')}}</li>
                        </ul>
                    </div> <!-- End extras -->
                </section> <!-- End links -->
                <hr />
                <section class="clearfix">
                    <div id="copyright">
                         <div id="logo">
                        <a href="#"><span id="logo-accent">e</span>Commerce</a>
                         </div> <!-- End Logo --> 
                        <p id="store-desc">This is a short description of the store</p>
                        <p id="store-copy">&copy; 2014 eCommerce. Theme designed by Adi Purdila.</p>                     
                    </div> <!-- End copyright -->
                    <div id="connect">
                        <h4>CONNECT WITH US</h4>
                        <ul>
                            <li class="twitter"><a href="#">Twitter</a></li>
                            <li class="fb"><a href="#">Facebook</a></li>
                        </ul>
                    </div> <!-- End connect -->
                    <div id="payments">
                        <h4>SUPPORTED PAYMENT METHODS</h4>
                        {{HTML::image('img/payment-methods.gif', 'Supported Payment Methods')}}
                    </div> <!-- End payments -->
                </section>
            </footer> 
           
       </div><!--End Wrappers -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write("{{HTML::script('js/vendor/jquery-1.10.2.min.js')}}")</script>
        {{HTML::script('js/plugins.js')}}
        {{HTML::script('js/main.js')}}

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>
