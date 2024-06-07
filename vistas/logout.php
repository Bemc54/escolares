<?php
    // Destruir la sesión
    session_destroy();
?>

<!DOCTYPE html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .progress-container {
            width: 200px;
            height: 20px;
            background-color: #ddd;
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn .25s ease-in-out;
        }

        .progress-bar {
            width: 0;
            height: 100%;
            background-color: #4caf50;
            border-radius: 10px;
            animation: fillProgress 2s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes fillProgress {
            0% { width: 0; }
            100% { width: 100%; }
        }
    </style>
    <script>
        // Redirige al usuario a la página de inicio después de un breve intervalo (2000 milisegundos = 2 segundos)
        setTimeout(function() {
            document.querySelector('.progress-bar').style.animation = 'none';
            window.location.replace('index.php');
        }, 2000);
    </script>
</head>
<body>
    <div class="progress-container">
        <div class="progress-bar"></div>
    </div>
</body>
</html>