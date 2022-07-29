<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>
        @if(View::hasSection('title'))
        @yield('title') -
        @endif
        Klinik Dr.Alfred
    </title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="/css/simplebar.css">

    <link rel="shortcut icon" href="">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="/css/feather.css">
    <link rel="stylesheet" href="/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/css/select2.css">
    <link rel="stylesheet" href="/css/dropzone.css">
    <link rel="stylesheet" href="/css/uppy.min.css">
    <link rel="stylesheet" href="/css/jquery.steps.css">
    <link rel="stylesheet" href="/css/jquery.timepicker.css">
    <link rel="stylesheet" href="/css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="/css/app-dark.css" id="darkTheme" disabled>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

    <style type="text/css">
        .parsley-errors-list li {
            list-style: none;
            color: red;
        }

        .handlelist{
            cursor: move;
            cursor: -webkit-grabbing;
        }

        .handleimage{
            cursor: move;
            cursor: -webkit-grabbing;
        }

        .ghost {
          opacity: 0.4;
        }

    </style>

  </head>
  <body class="vertical  light">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          {{-- <i class="fe fe-menu navbar-toggler-icon"></i> --}}
          <i class="navbar-toggler-icon" data-feather="menu" width="16" height="16"></i>
        </button>

        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
              {{-- <i class="fe fe-sun fe-16"></i> --}}
              <i data-feather="sun" width="16" height="16"></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">

                                    <img src="/img/avatars/profile.jpg"
                                    class="avatar-img rounded-circle" alt="user_name" />

                                <span>{{ Auth::user()->name }}</span>
                            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/profile">Profile</a>
              <a class="dropdown-item logout" data-url="/logout">Keluar</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-50 mb-4 d-flex">
            {{-- <a href="/"></a><img class="navbar-brand mx-auto mt-2 flex-fill text-center" src="{{url('https://i.ibb.co/n7HKTsK/Smart-Aquarium.png')}}" width="50"/> --}}
            <h2>Klinik Dr.Alfred</h2>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            {{-- Navbar --}}
            <li class="nav-item ">
                <a class="nav-link" href="/home">
                  <i class="fe fe-home fe-16"></i>
                  <span class="ml-3 item-text">Home</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="/queue">
                  <i class="fe fe-activity fe-16"></i>
                  <span class="ml-3 item-text">Antrian</span>
                </a>
              </li>


            {{-- Navbar --}}
          </ul>

        </nav>
      </aside>
      <main role="main" class="main-content">
        @yield('content')
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/simplebar.min.js"></script>
    <script src="/js/daterangepicker.js"></script>
    <script src="/js/jquery.stickOnScroll.js"></script>
    <script src="/js/tinycolor-min.js"></script>
    <script src="/js/config.js"></script>
    <script src="/js/d3.min.js"></script>
    <script src="/js/topojson.min.js"></script>
    <script src="/js/datamaps.all.min.js"></script>
    <script src="/js/datamaps-zoomto.js"></script>
    <script src="/js/datamaps.custom.js"></script>
    <script src="/js/Chart.min.js"></script>
    <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="/js/gauge.min.js"></script>
    <script src="/js/jquery.sparkline.min.js"></script>
    <script src="/js/apexcharts.min.js"></script>
    <script src="/js/apexcharts.custom.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script src="/js/jquery.steps.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/jquery.timepicker.js"></script>
    <script src="/js/dropzone.min.js"></script>
    <script src="/js/uppy.min.js"></script>
    <script src="/js/quill.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- include summernote css/js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <!-- include parsley js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.0/parsley.min.js"
        integrity="sha512-wNs1j1Vo1t0stXW7Lz5QL6T7a/9ClH7/X10Q4jd3aIcRsFTTPh0gRkTxRk0jgXcloVwNIrvmkyStp99hMObegQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>






    </script>

    <script src="/js/apps.js"></script>
    <!-- <script src="{{ url('js/app.js') }}"></script> -->
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>

    <script>
        $('.logout').click(function () {
        $('.logout').attr('disabled', true)
        var url = $(this).attr('data-url');
        Swal.fire({
            title: 'Apakah anda yakin ingin Logout ?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya. Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function (data) {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Berhasil!',
                                'Berhasil Logout.',
                                'success'
                            ).then(() => {
                                location.reload()
                            })
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire(
                            'Gagal!',
                            'Gagal Logout.',
                            'error'
                        );
                    }
                });
            }
        })
    });
    </script>

    @yield('script')
  </body>
</html>
