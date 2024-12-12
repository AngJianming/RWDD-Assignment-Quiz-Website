<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animated Background</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: hidden;
            /* Animated Gradient Background */
            background: linear-gradient(315deg, #6f006b 3%, #040031 38%, #4e0f63 68%, #48003b 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }

        canvas {
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
        }
    </style>
</head>
<body>
<canvas id="matrixCanvas"></canvas>
<script>
    const canvas = document.getElementById('matrixCanvas');
    const ctx = canvas.getContext('2d');

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // Characters for matrix rain
    const characters = '0    1    2    3    4    5    6    7    8    9';
    const charArray = characters.split('');

    const fontSize = 30; // Larger font size for more prominence
    const columns = Math.floor(canvas.width / fontSize);
    const drops = [];

    for (let i = 0; i < columns; i++) {
        drops[i] = Math.floor(Math.random() * canvas.height / fontSize);
    }

    let frameCount = 0; // Count frames to slow down movement

    function draw() {
        // Draw a semi-transparent black rectangle to create trailing effect
        ctx.fillStyle = 'rgba(0,0,0,0.05)';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        ctx.fillStyle = '#b027f4'; // Neon purple color
        ctx.font = fontSize + 'px monospace';

        // Update the drops position less frequently to slow down the rain
        frameCount++;
        const shouldMove = (frameCount % 5 === 0); // Move every 5 frames

        for (let i = 0; i < drops.length; i++) {
            const text = charArray[Math.floor(Math.random() * charArray.length)];
            const x = i * fontSize;
            const y = drops[i] * fontSize;

            ctx.fillText(text, x, y);

            // Move drop down one character only if shouldMove is true
            if (shouldMove) {
                drops[i]++;
                // Reset to top occasionally
                if (y > canvas.height && Math.random() > 0.975) {
                    drops[i] = 0;
                }
            }
        }

        requestAnimationFrame(draw);
    }

    draw();
</script>
</body>
</html>
