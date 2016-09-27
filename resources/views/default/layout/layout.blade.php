<!DOCTYPE html>
<html lang="zh-cn">
  @include(theme('layout.head'))

  <body role="document">

    @include(theme('layout.nav'))

    @yield('container')

    @include(theme('layout.foot'))
  </body>
</html>
