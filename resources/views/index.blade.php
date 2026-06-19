<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

    <header>
        <h1>My Website</h1>
    </header>

    <nav>
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </nav>

    <div class="container">
        <h1>Welcome</h1>
        <p>This is the homepage of our simple website.</p>

        <button onclick="showMessage()">Click Me</button>
        <button onclick="showDateTime()">Show Date & Time</button>

        <p id="datetime"></p>
    </div>

    <footer>
        &copy; 2026 My Website
    </footer>

    <script src="script.js"></script>
</body>
</html>