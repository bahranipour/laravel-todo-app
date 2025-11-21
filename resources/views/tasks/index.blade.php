<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لیست تسک ها</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">لیست تسک ها</h2>

        @if(session('success'))
            <div class="alert alert-succss">{{ session('success')}}</div>
        @endif 

        <form action="{{ route('tasks.store')}}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="عنوان تسک" required>
            </div>
            <div class="form-group">
                <textarea name="description" class="form-control" placeholder="توضیحات (اختیاری)"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">افزودن تسک</button>
        </form>
        @if($tasks->count())
            <ul class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-item-center">
                        <div>
                            <strong>{{ $task->title }}</strong>
                            @if($task->description)
                                <p class="mb-0 text-muted">{{ $task->description }}</p>
                            @endif 
                        </div>
                        <div>
                            <form action="{{ route('tasks.update', $task)}}" method="post" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="checkbox" name="completed" {{ $task->completed ? 'checked' : ''}} onchange="this.form.submit()">
                                <label class="mr-2">انجام شده</label>
                            </form>
                            <form action="{{ route('tasks.destroy',$task)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else 
            <div class="alert alert-warning text-center">هنوز تسکی وجود ندارد</div>
        @endif 
    </div>
    <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>