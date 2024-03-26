<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/movies/'. $movie->image) }}" class="rounded" style="width: 100%" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $movie->title }}</h3>
                        <hr>
                        {{-- <p>{{ "Rp " . number_format($product->price,2,',','.') }}</p> --}}
                        <p>Directed by <b>{{ $movie->director }}</b></p>
                        <p>Genre :  <b>{{ $movie->genre }}</b></p>
                        <p>Released in :  {{ $movie->year }}</p>
                        <p>Runtime :  {{ $movie->runtime }} minutes</p>
                        <p>Your review :</p>
                        <code>
                            <p> {!! $movie->review !!}</p>
                        </code>
                        <hr>
                        <h1>{{ $movie->rating }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>