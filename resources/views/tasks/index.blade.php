<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tasks Management</title>
</head>
<body>
    @if (count($errors) > 0)
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    @endif
    <form action="{{ url('tasks') }}" method="post">
    {{ csrf_field() }}
        <input type="text" name="name">
        <textarea name="description"></textarea>
        <input type="submit" value="Create Task">
    </form>
    <h1>Tasks Management</h1>
    <ul>
        @foreach ($tasks as $task)
            <li>
                {{ $task->name }} <br>
                {{ $task->description }}
            </li>
        @endforeach
    </ul>
</body>
</html>