
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- style -->
    @include('layouts.admin.partials.style')
    <!-- / style -->
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('layouts.admin.partials.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('layouts.admin.partials.topbar')
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row justify-content-between pb-2">
                    <div class="col">
                        <h5 class="fw-bold"><span class="text-muted fw-light"><a href="{{ route('admin.dashboard') }}"><i class="tf-icons bx bx-home-circle"></i> Dashboard</a></span> / {{ $title ?? '' }}</h5>
                    </div>
                    <div class="col text-end">
                        @foreach ($buttons ?? [] as $button)
                            <a href="{{ $button['link'] ?? 'javascript:void(0)' }}" {{ isset($button['modal']) ? 'data-bs-toggle=modal data-bs-target=#'.$button['modal'] : '' }} class="btn btn-primary btn-sm me-1"><i class='{{ $button['icon'] }}'></i> {{ $button['name'] }}</a>
                        @endforeach
                    </div>
                </div>

                @yield('contents')
                @stack('modal')
            </div>

            <!-- Footer -->
            @include('layouts.admin.partials.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('layouts.admin.partials.scripts')
  </body>
</html>
