<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <H1> AUTHORS </H1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia accusamus, consectetur voluptatibus exercitationem quas vero, nesciunt libero omnis ex vitae blanditiis nostrum aspernatur ullam quae? Ex rerum natus unde debitis.</p>

    <!-- @foreach($authors as $item)
        <ul>
            <li>{{$item ['id']}}</li>
            <li>{{$item ['name']}}</li>
            <li>{{$item ['photo']}}</li>
            <li>{{$item ['bio']}}</li>
        </ul>
    @endforeach -->
    
    @foreach($authors as $item)
        <ul>
            <li>{{$item ['name']}}</li>
            <li>{{$item ['photo']}}</li>
            <li>{{$item ['bio']}}</li>
        </ul>
    @endforeach
</body>
</html>