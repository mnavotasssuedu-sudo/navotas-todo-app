<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Todo List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }

        /* Blue & Purple Gradient Background */
        body {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #9333ea 100%);
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 750px;
            margin: 0 auto;
        }

        /* Header & Logout */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        h1 {
            color: #ffffff;
            font-size: 2.3rem;
            text-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.7rem 1.3rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        /* Success Alert */
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            background: #dbeafe;
            color: #1e40af;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 5px solid #4f46e5;
        }

        /* Card Design */
        .card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        .card h3 {
            color: #4f46e5;
            margin-bottom: 1.4rem;
            font-size: 1.5rem;
            border-bottom: 2px solid #e0e7ff;
            padding-bottom: 0.7rem;
        }

        /* Form Inputs */
        label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 500;
            color: #374151;
        }

        input, textarea {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.3rem;
            border: 2px solid #e0e7ff;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.2s ease;
            background-color: #fafbff;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
            background-color: #ffffff;
        }

        /* Add Task Button */
        .btn-add {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            border: none;
            padding: 0.9rem 1.8rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 3px 8px rgba(79, 70, 229, 0.25);
        }

        .btn-add:hover {
            background: linear-gradient(135deg, #4338ca, #6d28d9);
            transform: translateY(-1px);
        }

        /* Todo Item */
        .todo-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.3rem;
            margin-bottom: 1.1rem;
            border-radius: 10px;
            background: #f8faff;
            border-left: 5px solid #7c3aed;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .todo-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.12);
        }

        /* Completed Task Style */
        .todo-item.completed {
            background: #f0f4ff;
            border-left-color: #4f46e5;
            opacity: 0.85;
        }

        .todo-item.completed h4 {
            text-decoration: line-through;
            color: #6b7280;
        }

        .todo-item h4 {
            font-size: 1.15rem;
            color: #1e1b4b;
            margin-bottom: 0.4rem;
        }

        .todo-item p {
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            gap: 0.8rem;
        }

        .btn-toggle {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .btn-toggle:hover {
            background: #4338ca;
        }

        .btn-delete {
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: background 0.2s ease;
        }

        .btn-delete:hover {
            background: #b91c1c;
        }

        /* Empty State */
        .empty {
            text-align: center;
            padding: 3rem;
            color: #94a3b8;
            font-style: italic;
            font-size: 1.15rem;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Top Header -->
    <div class="top-bar">
        <h1>📝 My Todo List</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <!-- Add New Task Form -->
    <div class="card">
        <h3>➕ Add New Task</h3>
        <form action="{{ route('todos.store') }}" method="POST">
            @csrf
            <label>Title:</label>
            <input type="text" name="title" required placeholder="Enter your task title...">

            <label>Description (optional):</label>
            <textarea name="description" rows="2" placeholder="Add more details here..."></textarea>

            <button type="submit" class="btn-add">Save Task</button>
        </form>
    </div>

    <!-- Task List -->
    <div class="card">
        <h3>📋 Your Tasks</h3>

        @forelse($todos as $todo)
            <div class="todo-item {{ $todo->is_completed ? 'completed' : '' }}">
                <div>
                    <h4>{{ $todo->title }}</h4>
                    @if($todo->description)
                        <p>{{ $todo->description }}</p>
                    @endif
                </div>
                <div class="actions">
                    <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-toggle">
                            {{ $todo->is_completed ? 'Undo' : 'Mark Done' }}
                        </button>
                    </form>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty">No tasks yet. Add your first task above! ✨</div>
        @endforelse
    </div>
</div>

</body>
</html>