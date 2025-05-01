<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pracetak</title>

   <style>
      @page {
         margin: 10mm;
      }

      h1, h2, h3, h4, h5 {
         margin: 0;
      }

      .text-right {
         text-align: right;
      }

      .text-center {
         text-align: center;
      }

      .table {
         border-collapse: collapse;
      }

      .table th,
      .table td {
         padding: 2px 4px;
      }

      .table-bordered th,
      .table-bordered td {
         border: 1px solid;
      }
   </style>
</head>
<body>
   @yield('content')

</body>
</html>
