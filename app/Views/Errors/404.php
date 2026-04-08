<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page Not Found | Wasafat</title>
    <?php $baseUrl = '/Wasafat/'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --color-primary: #6b1d1d;
            --color-accent: #c0392b;
            --color-accent-hover: #a5281e;
            --color-accent-glow: rgba(192, 57, 43, 0.15);
            --color-bg: #faf8f5;
            --color-bg-alt: #f5f0ea;
            --color-card: #ffffff;
            --color-text: #333333;
            --color-text-light: #666666;
            --color-text-muted: #999999;
            --color-border: #e8e3dc;
            --color-border-light: #f0ece6;
            --color-gold: #e8c9a0;
            --color-cream: #f5e6d3;
            --color-brown: #a0522d;
            --color-navbar: #2c1414;
            --font-heading: 'Playfair Display', Georgia, serif;
            --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: var(--font-body);
            background: var(--color-bg);
            color: var(--color-text);
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }

        /* ===================== NAVBAR ===================== */
        .top-bar {
            background: var(--color-navbar);
            padding: 0 36px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 10;
        }

        .top-bar-brand {
            color: var(--color-gold);
            font-family: var(--font-heading);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.4px;
            transition: opacity 0.2s;
        }

        .top-bar-brand:hover { opacity: 0.8; }

        .top-bar-home {
            color: rgba(232, 201, 160, 0.6);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }

        .top-bar-home:hover { color: var(--color-gold); }

        /* ===================== MAIN AREA ===================== */
        .error-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            position: relative;
            background:
                radial-gradient(ellipse at 20% 80%, rgba(192, 57, 43, 0.03) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 20%, rgba(160, 82, 45, 0.04) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 50%, rgba(232, 201, 160, 0.06) 0%, transparent 70%);
        }

        /* Floating particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            animation: particleFloat linear infinite;
        }

        @keyframes particleFloat {
            0% { opacity: 0; transform: translateY(100vh) rotate(0deg); }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; transform: translateY(-10vh) rotate(360deg); }
        }

        /* Grid pattern overlay */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(160, 82, 45, 0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(160, 82, 45, 0.015) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        /* ===================== ERROR CARD ===================== */
        .error-card {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 560px;
            width: 100%;
        }

        /* ===================== PLATE SCENE ===================== */
        .plate-scene {
            position: relative;
            width: 260px;
            height: 260px;
            margin: 0 auto 36px;
        }

        /* Plate shadow */
        .plate-shadow {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 180px;
            height: 20px;
            background: radial-gradient(ellipse, rgba(0,0,0,0.08) 0%, transparent 70%);
            border-radius: 50%;
            animation: shadowPulse 4s ease-in-out infinite;
        }

        @keyframes shadowPulse {
            0%, 100% { transform: translateX(-50%) scaleX(1); opacity: 1; }
            50% { transform: translateX(-50%) scaleX(0.85); opacity: 0.7; }
        }

        /* Main plate */
        .plate-main {
            width: 210px;
            height: 210px;
            border-radius: 50%;
            position: absolute;
            top: 20px;
            left: 25px;
            animation: plateHover 4s ease-in-out infinite;
            cursor: pointer;
            transition: filter 0.3s;
        }

        .plate-main:hover {
            filter: brightness(1.02);
        }

        .plate-main:active {
            animation: plateSpin 0.6s ease;
        }

        @keyframes plateHover {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes plateSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Plate layers */
        .plate-outer {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(145deg, #ffffff 0%, #f8f5f0 50%, #ede8e0 100%);
            border: 1px solid rgba(200, 190, 175, 0.4);
            box-shadow:
                0 12px 40px rgba(0, 0, 0, 0.08),
                0 4px 12px rgba(0, 0, 0, 0.04),
                inset 0 2px 8px rgba(255, 255, 255, 0.9),
                inset 0 -3px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Plate rim pattern */
        .plate-rim {
            position: absolute;
            inset: 6px;
            border-radius: 50%;
            border: 1px solid rgba(200, 185, 165, 0.2);
        }

        .plate-rim::before {
            content: '';
            position: absolute;
            inset: 8px;
            border-radius: 50%;
            border: 1px dashed rgba(200, 185, 165, 0.15);
        }

        /* Moroccan rim decoration */
        .rim-pattern {
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            border: 2px solid transparent;
            background-clip: padding-box;
            opacity: 0.06;
            background: repeating-conic-gradient(
                var(--color-brown) 0deg 3deg,
                transparent 3deg 12deg
            );
            mask: radial-gradient(
                farthest-side,
                transparent calc(100% - 14px),
                black calc(100% - 13px) calc(100% - 2px),
                transparent calc(100% - 1px)
            );
            -webkit-mask: radial-gradient(
                farthest-side,
                transparent calc(100% - 14px),
                black calc(100% - 13px) calc(100% - 2px),
                transparent calc(100% - 1px)
            );
        }

        /* Plate center content */
        .plate-center {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 35%, #fff, #faf7f2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(200, 185, 165, 0.12);
        }

        .error-number {
            font-family: var(--font-heading);
            font-size: 54px;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, var(--color-accent), #d44637);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 1px 2px rgba(192, 57, 43, 0.15));
            transition: transform 0.3s;
        }

        .plate-main:hover .error-number {
            transform: scale(1.05);
        }

        .error-label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: var(--color-text-muted);
        }

        /* Steam */
        .steam-group {
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 3;
        }

        .steam-line {
            width: 3px;
            border-radius: 10px;
            background: linear-gradient(to top, rgba(180, 170, 155, 0.25), transparent);
            animation: steamFloat 2.2s ease-out infinite;
        }

        .steam-line:nth-child(1) { height: 22px; animation-delay: 0s; }
        .steam-line:nth-child(2) { height: 30px; animation-delay: 0.35s; }
        .steam-line:nth-child(3) { height: 18px; animation-delay: 0.7s; }
        .steam-line:nth-child(4) { height: 24px; animation-delay: 1.05s; }

        @keyframes steamFloat {
            0% { opacity: 0; transform: translateY(0) scaleX(1); }
            30% { opacity: 0.7; }
            70% { opacity: 0.3; transform: translateY(-20px) scaleX(1.6); }
            100% { opacity: 0; transform: translateY(-36px) scaleX(0.4); }
        }

        /* Orbiting food */
        .orbit-ring {
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            animation: orbitSpin 20s linear infinite;
        }

        .orbit-item {
            position: absolute;
            font-size: 26px;
            filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.1));
            animation: orbitCounterSpin 20s linear infinite;
            transition: transform 0.3s;
        }

        .orbit-item:hover {
            transform: scale(1.3) !important;
        }

        .orbit-item:nth-child(1) { top: -8px; left: 50%; transform: translateX(-50%); }
        .orbit-item:nth-child(2) { bottom: -8px; left: 50%; transform: translateX(-50%); }
        .orbit-item:nth-child(3) { left: -12px; top: 50%; transform: translateY(-50%); }
        .orbit-item:nth-child(4) { right: -12px; top: 50%; transform: translateY(-50%); }
        .orbit-item:nth-child(5) { top: 12px; right: 8px; }
        .orbit-item:nth-child(6) { bottom: 12px; left: 8px; font-size: 20px; }

        @keyframes orbitSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes orbitCounterSpin {
            from { transform: rotate(0deg); }
            to { transform: rotate(-360deg); }
        }

        /* Sparkle */
        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--color-gold);
            animation: sparkleAnim 3s ease-in-out infinite;
            pointer-events: none;
        }

        .sparkle:nth-child(1) { top: 15%; right: 18%; animation-delay: 0s; }
        .sparkle:nth-child(2) { bottom: 20%; left: 15%; animation-delay: 1s; }
        .sparkle:nth-child(3) { top: 45%; right: 8%; animation-delay: 2s; width: 3px; height: 3px; }

        @keyframes sparkleAnim {
            0%, 100% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; transform: scale(1); }
        }

        /* ===================== TEXT CONTENT ===================== */
        .error-title {
            font-family: var(--font-heading);
            font-size: 30px;
            color: var(--color-primary);
            font-weight: 700;
            margin-bottom: 14px;
            line-height: 1.3;
            letter-spacing: -0.3px;
        }

        .error-title span {
            position: relative;
            display: inline-block;
        }

        .error-title span::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            right: 0;
            height: 8px;
            background: var(--color-accent-glow);
            border-radius: 4px;
            z-index: -1;
        }

        .error-desc {
            font-size: 15px;
            color: var(--color-text-light);
            line-height: 1.8;
            margin-bottom: 8px;
            max-width: 440px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-url {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11.5px;
            color: var(--color-text-muted);
            margin-bottom: 36px;
            background: var(--color-bg-alt);
            padding: 8px 16px;
            border-radius: 20px;
            border: 1px solid var(--color-border-light);
        }

        .error-url i {
            font-size: 10px;
            color: var(--color-brown);
        }

        .error-url code {
            font-family: 'SF Mono', 'Fira Code', 'Cascadia Code', monospace;
            font-size: 11px;
            color: var(--color-brown);
            max-width: 220px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ===================== BUTTONS ===================== */
        .btn-group {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .btn-404 {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 14px 32px;
            font-size: 14px;
            font-weight: 600;
            font-family: var(--font-body);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            position: relative;
            overflow: hidden;
        }

        .btn-404::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-404:hover::before { opacity: 1; }

        .btn-404 i {
            font-size: 14px;
            transition: transform 0.3s;
        }

        /* Home button */
        .btn-go-home {
            background: linear-gradient(135deg, var(--color-accent), #d44637);
            color: #fff;
            box-shadow:
                0 4px 16px rgba(192, 57, 43, 0.3),
                0 1px 3px rgba(192, 57, 43, 0.2);
        }

        .btn-go-home:hover {
            transform: translateY(-3px);
            box-shadow:
                0 8px 28px rgba(192, 57, 43, 0.35),
                0 2px 6px rgba(192, 57, 43, 0.2);
        }

        .btn-go-home:hover i { transform: translateX(-2px); }

        .btn-go-home:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(192, 57, 43, 0.25);
        }

        /* Back button */
        .btn-go-back {
            background: var(--color-card);
            color: var(--color-text-light);
            border: 1.5px solid var(--color-border);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .btn-go-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.07);
            background: var(--color-bg-alt);
            color: var(--color-text);
            border-color: #d4c9b8;
        }

        .btn-go-back:hover i { transform: translateX(-3px); }

        .btn-go-back:active {
            transform: translateY(-1px);
        }

        /* ===================== DIVIDER ===================== */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 30px auto 24px;
            max-width: 320px;
        }

        .section-divider::before,
        .section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--color-border), transparent);
        }

        .section-divider span {
            font-size: 10px;
            color: var(--color-text-muted);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* ===================== QUICK LINKS ===================== */
        .explore-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .explore-link {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 12.5px;
            font-weight: 500;
            color: var(--color-text-light);
            background: var(--color-card);
            border: 1px solid var(--color-border-light);
            transition: all 0.25s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .explore-link:hover {
            background: var(--color-bg-alt);
            border-color: var(--color-border);
            color: var(--color-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .explore-link i {
            font-size: 13px;
            color: var(--color-brown);
            transition: color 0.2s;
        }

        .explore-link:hover i {
            color: var(--color-accent);
        }

        /* ===================== KEYBOARD HINTS ===================== */
        .keyboard-hints {
            margin-top: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .kbd-hint {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10.5px;
            color: var(--color-text-muted);
        }

        kbd {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 24px;
            height: 22px;
            padding: 0 6px;
            background: var(--color-card);
            border: 1px solid var(--color-border);
            border-radius: 5px;
            font-family: var(--font-body);
            font-size: 10px;
            font-weight: 600;
            color: var(--color-text-light);
            box-shadow: 0 1px 2px rgba(0,0,0,0.06), inset 0 -1px 0 rgba(0,0,0,0.05);
        }

        /* ===================== FOOTER ===================== */
        .bottom-bar {
            text-align: center;
            padding: 16px 20px;
            border-top: 1px solid var(--color-border-light);
            background: var(--color-card);
        }

        .bottom-bar p {
            font-size: 10.5px;
            color: #bbb;
            letter-spacing: 0.5px;
        }

        .bottom-bar p span {
            color: var(--color-accent);
        }

        /* ===================== ANIMATIONS ===================== */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .anim-1 { animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.0s both; }
        .anim-2 { animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.12s both; }
        .anim-3 { animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.24s both; }
        .anim-4 { animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.36s both; }
        .anim-5 { animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.48s both; }
        .anim-6 { animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.60s both; }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 600px) {
            .top-bar { padding: 0 20px; height: 50px; }
            .top-bar-brand { font-size: 18px; }

            .plate-scene { width: 210px; height: 210px; }
            .plate-main { width: 170px; height: 170px; top: 16px; left: 20px; }
            .plate-center { width: 115px; height: 115px; }
            .error-number { font-size: 42px; }
            .orbit-item { font-size: 20px; }
            .plate-shadow { width: 140px; }

            .error-title { font-size: 24px; }
            .error-desc { font-size: 13.5px; padding: 0 8px; }

            .btn-group {
                flex-direction: column;
                gap: 10px;
            }

            .btn-404 {
                width: 100%;
                max-width: 280px;
                justify-content: center;
                padding: 13px 28px;
            }

            .explore-links {
                flex-direction: column;
                gap: 6px;
            }

            .explore-link {
                width: 100%;
                max-width: 240px;
                justify-content: center;
            }

            .keyboard-hints { display: none; }
        }

        @media (max-width: 380px) {
            .plate-scene { width: 180px; height: 180px; }
            .plate-main { width: 150px; height: 150px; top: 14px; left: 15px; }
            .plate-center { width: 100px; height: 100px; }
            .error-number { font-size: 36px; }
            .error-title { font-size: 21px; }
            .steam-group { display: none; }
        }

        @media (min-width: 1200px) {
            .error-card { max-width: 600px; }
            .error-title { font-size: 34px; }
            .error-desc { font-size: 16px; max-width: 480px; }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar
    <nav class="top-bar">
        <a href="/" class="top-bar-brand">Wasafat</a>
        <a href="/" class="top-bar-home">
            <i class="fas fa-home"></i> Home
        </a>
    </nav> -->

    <!-- Main Content -->
    <div class="error-wrapper">
        <div class="grid-overlay"></div>

        <!-- Floating Particles (generated by JS) -->
        <div id="particlesContainer"></div>

        <div class="error-card">

            <!-- Plate Scene -->
            <div class="plate-scene anim-1">

                <!-- Steam -->
                <div class="steam-group">
                    <div class="steam-line"></div>
                    <div class="steam-line"></div>
                    <div class="steam-line"></div>
                    <div class="steam-line"></div>
                </div>

                <!-- Orbiting Items -->
                <div class="orbit-ring">
                    <span class="orbit-item">🥄</span>
                    <span class="orbit-item">🌶️</span>
                    <span class="orbit-item">🫒</span>
                    <span class="orbit-item">🍋</span>
                    <span class="orbit-item">🧄</span>
                    <span class="orbit-item">🌿</span>
                </div>

                <!-- Sparkles -->
                <div class="sparkle"></div>
                <div class="sparkle"></div>
                <div class="sparkle"></div>

                <!-- Plate -->
                <div class="plate-main" id="plateMain" title="Click me for a surprise!">
                    <div class="plate-outer">
                        <div class="rim-pattern"></div>
                        <div class="plate-rim"></div>
                        <div class="plate-center">
                            <span class="error-number" id="errorNumber">404</span>
                            <span class="error-label">not found</span>
                        </div>
                    </div>
                </div>

                <!-- Shadow -->
                <div class="plate-shadow"></div>
            </div>

            <!-- Title -->
            <h1 class="error-title anim-2">
                This Dish Isn't on the <span>Menu</span>
            </h1>

            <!-- Description -->
            <p class="error-desc anim-3">
                The page you're searching for seems to have vanished from our kitchen.
                It may have been moved, renamed, or simply never existed.
            </p>

            <!-- URL Display -->
            <div class="error-url anim-3">
                <i class="fas fa-link"></i>
                <code id="requestedUrl"></code>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group anim-4">
                <button class="btn-404 btn-go-back" onclick="goBack()">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </button>
                <a href="<?= $baseUrl ?>" class="btn-404 btn-go-home">
                    <i class="fas fa-home"></i>
                    Go Home
                </a>
            </div>

            <!-- Divider -->
            <?php if (!empty($_SESSION['user'])): ?>
            <div class="section-divider anim-5">
                <span>explore</span>
            </div>

            <!-- Quick Navigation -->
            <nav class="explore-links anim-5">
                <a href="<?= $baseUrl ?>recipes" class="explore-link">
                    <i class="fas fa-book"></i> Recipes
                </a>
                <a href="<?= $baseUrl ?>categories" class="explore-link">
                    <i class="fas fa-layer-group"></i> Categories
                </a>
                <a href="<?= $baseUrl ?>dashboard" class="explore-link">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                <a href="<?= $baseUrl ?>recipes/create" class="explore-link">
                    <i class="fas fa-plus-circle"></i> New Recipe
                </a>
            </nav>
            <?php endif; ?>

            <!-- Keyboard Shortcuts -->
            <div class="keyboard-hints anim-6">
                <div class="kbd-hint">
                    <kbd>Esc</kbd> Go back
                </div>
                <div class="kbd-hint">
                    <kbd>H</kbd> Go home
                </div>
                <?php if (!empty($_SESSION['user'])): ?>
                <div class="kbd-hint">
                    <kbd>R</kbd> Recipes
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bottom-bar">
        <p>© <?= date('Y') ?> Wasafat — Crafted with <span>♥</span> and spice</p>
    </footer>

    <script>
        // ======================== URL DISPLAY ========================
        document.getElementById('requestedUrl').textContent = window.location.pathname;

        // ======================== GO BACK ========================
        function goBack() {
            if (document.referrer && new URL(document.referrer).origin === window.location.origin) {
                window.history.back();
            } else {
                window.location.href = '<?= $baseUrl ?>';
            }
        }

        // ======================== KEYBOARD SHORTCUTS ========================
        const isLoggedIn = <?= !empty($_SESSION['user']) ? 'true' : 'false' ?>;
        
        document.addEventListener('keydown', function (e) {
            if (['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement.tagName)) return;

            switch (e.key) {
                case 'Escape':
                    goBack();
                    break;
                case 'h':
                case 'H':
                    window.location.href = '<?= $baseUrl ?>';
                    break;
                case 'r':
                case 'R':
                    if (isLoggedIn) {
                        window.location.href = '<?= $baseUrl ?>recipes';
                    }
                    break;
            }
        });

        // ======================== PLATE INTERACTIONS ========================
        const plate = document.getElementById('plateMain');
        const errorNum = document.getElementById('errorNumber');
        const orbitItems = document.querySelectorAll('.orbit-item');

        const allFoods = [
            '🍲', '🥘', '🍜', '🍝', '🥗', '🧆', '🫕', '🍛',
            '🥧', '🍰', '🧁', '🍩', '🥐', '🍕', '🌮', '🥙',
            '🍣', '🍱', '🥟', '🍤', '🧀', '🥑', '🍅', '🌽'
        ];

        const funMessages = [
            "This Dish Isn't on the Menu",
            "Still searching? 🔍",
            "That recipe vanished! 💨",
            "Our chef is confused too 👨‍🍳",
            "Error: Too many spices 🌶️",
            "Kitchen's closed for this one 🚪",
            "You found a secret! ...or not 🤫",
            "Let's get you back on track! 🛤️",
        ];

        let clickCount = 0;
        let isSpinning = false;

        plate.addEventListener('click', function () {
            if (isSpinning) return;
            isSpinning = true;
            clickCount++;

            // Spin plate
            this.style.animation = 'none';
            void this.offsetHeight;
            this.style.animation = 'plateSpin 0.6s ease';

            setTimeout(() => {
                this.style.animation = 'plateHover 4s ease-in-out infinite';
                isSpinning = false;
            }, 650);

            // Shuffle orbiting food
            orbitItems.forEach(item => {
                item.textContent = allFoods[Math.floor(Math.random() * allFoods.length)];
                item.style.animation = 'none';
                void item.offsetHeight;
                item.style.animation = '';
            });

            // Change title with random message
            const title = document.querySelector('.error-title');
            const titleSpan = title.querySelector('span');
            if (clickCount <= funMessages.length) {
                const msg = funMessages[Math.min(clickCount, funMessages.length - 1)];
                const lastWord = msg.split(' ').pop();
                const rest = msg.split(' ').slice(0, -1).join(' ');
                title.innerHTML = rest + ' <span>' + lastWord + '</span>';
            }

            // Easter eggs
            if (clickCount === 5) {
                errorNum.style.transition = 'transform 0.3s';
                errorNum.style.transform = 'scale(1.2)';
                errorNum.textContent = '🍳';
                setTimeout(() => {
                    errorNum.textContent = '404';
                    errorNum.style.transform = '';
                }, 2500);
            }

            if (clickCount === 10) {
                errorNum.textContent = '🎉';
                plate.style.boxShadow = '0 0 30px rgba(192, 57, 43, 0.3)';
                setTimeout(() => {
                    errorNum.textContent = '404';
                    plate.style.boxShadow = '';
                }, 3000);
            }

            if (clickCount === 15) {
                document.body.style.transition = 'background 0.5s';
                document.body.style.background = '#2c1414';
                setTimeout(() => {
                    document.body.style.background = '';
                }, 1500);
                errorNum.textContent = '🌙';
                setTimeout(() => { errorNum.textContent = '404'; }, 2000);
            }
        });

        // ======================== FLOATING PARTICLES ========================
        function createParticles() {
            const container = document.getElementById('particlesContainer');
            const emojis = ['✦', '✧', '⋆', '∗', '·'];

            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.textContent = emojis[Math.floor(Math.random() * emojis.length)];

                const size = Math.random() * 6 + 3;
                const left = Math.random() * 100;
                const duration = Math.random() * 15 + 15;
                const delay = Math.random() * 15;

                Object.assign(particle.style, {
                    left: left + '%',
                    width: size + 'px',
                    height: size + 'px',
                    fontSize: size + 'px',
                    color: `rgba(160, 82, 45, ${Math.random() * 0.15 + 0.05})`,
                    animationDuration: duration + 's',
                    animationDelay: delay + 's',
                });

                container.appendChild(particle);
            }
        }

        createParticles();

        // ======================== DYNAMIC GREETING ========================
        (function () {
            const hour = new Date().getHours();
            const greetEmoji = hour < 12 ? '🌅' : hour < 17 ? '☀️' : hour < 21 ? '🌆' : '🌙';
            const steamGroup = document.querySelector('.steam-group');

            if (hour >= 21 || hour < 6) {
                // Night mode — less steam, darker tones
                steamGroup.style.opacity = '0.4';
            }
        })();
    </script>

</body>
</html>