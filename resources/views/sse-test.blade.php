<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SSE Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f4f4f4; }
        #messages { border: 1px solid #ccc; padding: 20px; height: 300px; overflow-y: auto; background: #fff; }
        .message { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Laravel SSE Test</h1>
    <div id="messages"></div>

    <script>
        const messagesDiv = document.getElementById('messages');
        const evtSource = new EventSource("{{ route('sse') }}");

        evtSource.onmessage = function(event) {
            const data = JSON.parse(event.data);
            const p = document.createElement('p');
            p.classList.add('message');
            p.textContent = data.message;
            messagesDiv.appendChild(p);
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        };

        evtSource.onerror = function(err) {
            console.error("SSE error:", err);
            evtSource.close();
        };
    </script>
</body>
</html>
