<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MaxNEWS</title>
     <link rel="icon" href="https://e7.pngegg.com/pngimages/339/256/png-clipart-yellow-lightning-artwork-lightning-bolt-symbol-lighting-angle-triangle.png" type="image/x-icon">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <style>
    html{
      min-height: 100%;
      height: 100%;
      width: 100%;
    }

    .eventAuthor{
      font-style:italic;
      font-size: 14pt;
      color: red;
    }
    .image{
      height: 3%;
      width: 3%;
      background-color: white;
    }
    .message{
      border: 1px solid black;
      background-color: lightgray;
      padding-bottom: 2%;
    }
    .twit{
      margin-top: 3%;
    }
    .author{
      font-weight: bold;
      font-family: monospace;
      font-size: 15pt;
    }
    .forHeader{
      margin-bottom: 2%;
      background-color: darkslategray;
      width: 100%;
      height: 15%;
    }
    .navbar-brand{
      color: white;
    }
    .navbar-brand:hover{
      color: lightgray;
    }
    #event-title{
      width: 15%;
    }
    #event-theme{
      width: 25%;
    }
    #event-message{
      min-height: 70%;
      height: 50%;
      min-width: 50%;
      margin-bottom: 1%;
    }
    .forMessage{
      border: 1px solid gray;
      padding-bottom: 15%;
      padding-right: 15%;
      margin-bottom: 1%;
    }
    .text-right{
      text-align: right;
    }
    #addNew{
      width: 100%;
    }
    #bodyForEvent{
      text-align: center;
    }
    #buttonChange{
      margin-right: 3%;
    }
    .navbar-right{
      text-align: right;

    }
    .emptySpace{
      margin-top: 7%;
      color: white;
    }
    #icon{
      float: right;
      margin-top: 0.3%;
      text-align: right;
    }
    

    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  <div class="forHeader">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">



                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                      NEWS
                    </a>
                    <a class="navbar-brand" href="{{ url('/blogs') }}">
                      BLOGS
                    </a>
                    @if (!Auth::guest())
                    @if (Auth::user()->usertype == 'redactor' || Auth::user()->usertype == 'admin')
                    <a class="navbar-brand" href="{{ url('/themes') }}">
                      THEMES
                    </a>
                    @endif
                    @endif
                </div>

                    <!-- Right Side Of Navbar -->
                    <div class="navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        <div class="container">
                              <a href="{{ url('/login') }}" class="navbar-brand">Login</a>
                              <a href="{{ url('/register') }}" class="navbar-brand">Register</a>
                            </div>
                        @else
                        <div class="navbar-right">
                          <div class="container">
                            @if (Auth::user()->usertype == 'admin')
                                <a href="/admin" class="navbar-brand">USERS</a>
                                @endif
                                <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="navbar-brand">
                                                     <img src="http://cdn.onlinewebfonts.com/svg/download_359060.png" width="30"
                                                     height="30" border="0">
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                          </div>
                        </div>
                        @endif
                    </div>

            </div>
        </nav>
    </div>
    </div>
    <div class="container">


        @yield('content')
        </div>




    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
