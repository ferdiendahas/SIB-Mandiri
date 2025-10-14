<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat datang</title>
</head>
<body>
    <h1>welcome genres</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum dolorum necessitatibus labore aliquid nostrum similique optio consectetur rerum consequuntur eligendi officia quae fugit, id ducimus natus totam vel libero? Non!</p>

    @foreach($genres as $item)
        <ul>
            <li>{{$item ['id']}}</li>
            <li>{{$item ['genre']}}</li>
            <li>{{$item ['description']}}</li>
        </ul>
    @endforeach

</body>
</html>