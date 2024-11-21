<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta name="author" content="Teqpace">
      <meta name="keywords" content="Reminder, Schedule emails, email reminder, Remifo">
      <meta name="description" content="Remifo is an application which schedules reminders to be sent out to emails at intervals">

      <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
      <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
      <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">

     <title>{{ env('APP_NAME') }} Platform | @yield('name')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    @include('layouts.auth.css')
    @yield('style')
  </head>
  <body>
    <!-- login page start-->
    @yield('content')
    <!-- latest jquery-->
    @include('layouts.auth.script')
  </body>
</html>
