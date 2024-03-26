<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="image" class="font-weight-bold">IMAGE</label>
                                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">

                                {{-- error message for image --}}
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="title" class="font-weight-bold">TITLE</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $movie->title) }}">

                                {{-- error message for title --}}
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="director" class="font-weight-bold">DIRECTOR</label>
                                <input type="text" name="director" id="director" class="form-control @error('director') is-invalid @enderror" value="{{ old('director', $movie->director) }}">

                                {{-- error message for director --}}
                                @error('director')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="genre" class="font-weight-bold">GENRE</label>
                                <select name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre', $movie->genre) }}">
                                    <option value="action">Action</option>
                                    <option value="adventure">Adventure</option>
                                    <option value="drama">Drama</option>
                                    <option value="mystery">Mystery</option>
                                    <option value="horror">Horror</option>
                                    <option value="thriller">Thriller</option>
                                </select>

                                {{-- error message for genre --}}
                                @error('genre')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="year" class="font-weight-bold">YEAR</label>
                                        <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $movie->year) }}">

                                        {{-- error message for year --}}
                                        @error('year')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="runtime" class="font-weight-bold">RUNTIME</label>
                                        <input type="number" name="runtime" id="runtime" class="form-control @error('runtime') is-invalid @enderror" value="{{ old('runtime', $movie->runtime) }}">

                                        {{-- error message for runtime --}}
                                        @error('runtime')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold ">RATING</label>
                                        <input min="1" max="10" type="number" name="rating" id="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $movie->rating) }}">
                                    
                                        <!-- error message untuk rating -->
                                        @error('rating')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="review" class="font-weight-bold">REVIEW</label>
                                <textarea name="review" id="review" class="form-control @error('review') is-invalid @enderror" rows="5" placeholder="What do you think about the movie" value="{{ old('review', $movie->review) }}"></textarea>

                                {{-- error message for description --}}
                                @error('review')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    
</body>
</html>