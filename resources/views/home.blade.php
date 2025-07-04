<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 123</title>
</head>
<body>

    @auth
    <p>Congratulations, you are logged in!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>
    </form>

    <div style="border: 3px solid black">
        <h2>Create a New Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="post title">
            <textarea name="body" placeholder="post body"></textarea>
            <button>Save Post</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>all posts</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>

            </form>
        </div>
        @endforeach
    </div>

    @else
    <div style="border: 3px solid black;">
        <h2>Register</h2>

        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Register</button>
        </form>
    </div>

    <div style="border: 3px solid black;">
        <h2>Login</h2>

        <form action="/login" method="POST">
            @csrf
            <input type="text" name="loginname" placeholder="Name" required>
            <input type="password" name="loginpassword" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
    </div>
    @endauth

    <h1>Laravel 123</h1>


</body>
</html>
