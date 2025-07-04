<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT') <!-- Ensures the form sends a PUT request -->
        <input type="text" name="title" value="{{$post->title}}" placeholder="Post Title" required>
        <textarea name="body" placeholder="Post Body" required>{{$post->body}}</textarea>
        <button>Save Post</button>
    </form>
</body>
</html>
