<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat datang</title>
</head>
<body>
    <h1>Hello world</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum dolorum necessitatibus labore aliquid nostrum similique optio consectetur rerum consequuntur eligendi officia quae fugit, id ducimus natus totam vel libero? Non!</p>

    <!-- @foreach($books as $item)
        <ul>
            <li>{{$item ['title']}}</li>
            <li>{{$item ['description']}}</li>
            <li>{{$item ['price']}}</li>
            <li>{{$item ['stock']}}</li>
        </ul>
    @endforeach -->

    @foreach($books as $book)
        <ul>
            <li>{{$book ['title']}}</li>
            <li>{{$book ['description']}}</li>
            <li>{{$book ['price']}}</li>
            <li>{{$book ['stock']}}</li>
            <li>{{$book ['cover_photo']}}</li>
            <li>{{$book ['genre_id']}}</li>
            <li>{{$book ['author_id']}}</li>
        </ul>
    @endforeach
</body>
</html>