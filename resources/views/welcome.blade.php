<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app" class="my-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <index-quality></index-quality>
            </div>
            <div class="col-lg-6">
                <compare-quality></compare-quality>
            </div>


        </div>
    </div>

</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>