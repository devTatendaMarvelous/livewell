<!DOCTYPE html>
                    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
                    <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <title>{{config('app.name')}}</title>
                        <link rel="icon" href="{{asset('logo.png')}}" type="image/x-icon"><!-- [Font] Family -->
                        <!-- Fonts -->
                        <link rel="preconnect" href="https://fonts.bunny.net">
                        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

                        <style>
                            * {
                                margin: 0;
                                padding: 0;
                                box-sizing: border-box;
                            }

                            :root {
                                --primary-green: #48c774;
                                --dark-green: #2d8653;
                                --light-green: #7de5a0;
                                --bg-dark: #0f172a;
                                --bg-light: #1e293b;
                                --text-light: #e2e8f0;
                                --text-muted: #94a3b8;
                            }

                            body {
                                font-family: 'Figtree', sans-serif;
                                background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-light) 100%);
                                color: var(--text-light);
                                overflow-x: hidden;
                            }

                            /* Navigation */
                            .navbar {
                                position: fixed;
                                top: 0;
                                width: 100%;
                                /*padding: 1.5rem 2rem;*/
                                display: flex;
                                justify-content: space-between;
                                align-items: center;
                                background: rgba(15, 23, 42, 0.9);
                                backdrop-filter: blur(10px);
                                z-index: 1000;
                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                            }

                            .logo {
                                font-size: 1.5rem;
                                font-weight: 700;
                                color: var(--primary-green);
                                display: flex;
                                align-items: center;
                                gap: 0.5rem;
                            }

                            .nav-links {
                                display: flex;
                                gap: 2rem;
                                align-items: center;
                            }

                            .nav-links a {
                                color: var(--text-light);
                                text-decoration: none;
                                font-weight: 500;
                                transition: color 0.3s;
                            }

                            .nav-links a:hover {
                                color: var(--primary-green);
                            }

                            .btn-primary {
                                background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
                                color: white;
                                padding: 0.75rem 1.5rem;
                                border-radius: 8px;
                                border: none;
                                font-weight: 600;
                                cursor: pointer;
                                transition: transform 0.3s, box-shadow 0.3s;
                                text-decoration: none;
                                display: inline-block;
                            }

                            .btn-primary:hover {
                                transform: translateY(-2px);
                                box-shadow: 0 8px 16px rgba(72, 199, 116, 0.3);
                            }

                            /* Hero Section */
                            .hero {
                                min-height: 100vh;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                padding: 8rem 2rem 4rem;
                                text-align: center;
                            }

                            .hero-content h1 {
                                font-size: 3.5rem;
                                font-weight: 700;
                                margin-bottom: 1.5rem;
                                background: linear-gradient(135deg, var(--primary-green), var(--light-green));
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;
                                background-clip: text;
                            }

                            .hero-content p {
                                font-size: 1.25rem;
                                color: var(--text-muted);
                                max-width: 600px;
                                margin: 0 auto 2rem;
                            }

                            .hero-buttons {
                                display: flex;
                                gap: 1rem;
                                justify-content: center;
                                flex-wrap: wrap;
                            }

                            /* Features Section */
                            .features {
                                padding: 4rem 2rem;
                                max-width: 1200px;
                                margin: 0 auto;
                            }

                            .features h2 {
                                text-align: center;
                                font-size: 2.5rem;
                                margin-bottom: 3rem;
                                color: var(--primary-green);
                            }

                            .features-grid {
                                display: grid;
                                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                                gap: 2rem;
                            }

                            .feature-card {
                                background: rgba(30, 41, 59, 0.6);
                                padding: 2rem;
                                border-radius: 12px;
                                border: 1px solid rgba(72, 199, 116, 0.2);
                                transition: transform 0.3s, border-color 0.3s;
                            }

                            .feature-card:hover {
                                transform: translateY(-8px);
                                border-color: var(--primary-green);
                            }

                            .feature-icon {
                                font-size: 2.5rem;
                                color: var(--primary-green);
                                margin-bottom: 1rem;
                            }

                            .feature-card h3 {
                                font-size: 1.5rem;
                                margin-bottom: 1rem;
                            }

                            /* Chat Section */
                            .chat-section {
                                padding: 4rem 2rem;
                                max-width: 1200px;
                                margin: 0 auto;
                            }

                            .chat-header {
                                text-align: center;
                                margin-bottom: 3rem;
                            }

                            .chat-header h2 {
                                font-size: 2.5rem;
                                color: var(--primary-green);
                                margin-bottom: 1rem;
                            }

                            .chat-container {
                                max-width: 900px;
                                margin: 0 auto;
                                background: rgba(30, 41, 59, 0.8);
                                border-radius: 16px;
                                border: 1px solid rgba(72, 199, 116, 0.3);
                                overflow: hidden;
                                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
                            }

                            .chat-messages {
                                height: 500px;
                                overflow-y: auto;
                                padding: 2rem;
                                display: flex;
                                flex-direction: column;
                                gap: 1rem;
                            }

                            .chat-messages::-webkit-scrollbar {
                                width: 8px;
                            }

                            .chat-messages::-webkit-scrollbar-track {
                                background: rgba(15, 23, 42, 0.5);
                            }

                            .chat-messages::-webkit-scrollbar-thumb {
                                background: var(--primary-green);
                                border-radius: 4px;
                            }

                            .message {
                                display: flex;
                                gap: 1rem;
                                animation: slideIn 0.3s ease-out;
                            }

                            @keyframes slideIn {
                                from {
                                    opacity: 0;
                                    transform: translateY(10px);
                                }
                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            .message.user {
                                flex-direction: row-reverse;
                            }

                            .message-avatar {
                                width: 40px;
                                height: 40px;
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 1.2rem;
                                flex-shrink: 0;
                            }

                            .message.ai .message-avatar {
                                background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
                                animation: pulse 2s infinite;
                            }

                            @keyframes pulse {
                                0%, 100% {
                                    box-shadow: 0 0 0 0 rgba(72, 199, 116, 0.7);
                                }
                                50% {
                                    box-shadow: 0 0 0 10px rgba(72, 199, 116, 0);
                                }
                            }

                            .message.user .message-avatar {
                                background: linear-gradient(135deg, #667eea, #764ba2);
                            }

                            .message-content {
                                max-width: 70%;
                                padding: 1rem 1.5rem;
                                border-radius: 16px;
                                line-height: 1.6;
                            }

                            .message.ai .message-content {
                                background: rgba(72, 199, 116, 0.15);
                                border: 1px solid rgba(72, 199, 116, 0.3);
                            }

                            .message.user .message-content {
                                background: rgba(102, 126, 234, 0.15);
                                border: 1px solid rgba(102, 126, 234, 0.3);
                            }

                            .diagnosis-result {
                                margin-top: 1rem;
                                padding: 1rem;
                                background: rgba(72, 199, 116, 0.1);
                                border-left: 4px solid var(--primary-green);
                                border-radius: 8px;
                            }

                            .diagnosis-result h4 {
                                color: var(--primary-green);
                                margin-bottom: 0.5rem;
                                font-size: 1.2rem;
                            }

                            .diagnosis-result p {
                                margin: 0.5rem 0;
                            }

                            .diagnosis-result strong {
                                color: var(--light-green);
                            }

                            .typing-indicator {
                                display: none;
                                gap: 0.3rem;
                                padding: 1rem 1.5rem;
                            }

                            .typing-indicator.active {
                                display: flex;
                            }

                            .typing-dot {
                                width: 8px;
                                height: 8px;
                                background: var(--primary-green);
                                border-radius: 50%;
                                animation: typing 1.4s infinite;
                            }

                            .typing-dot:nth-child(2) {
                                animation-delay: 0.2s;
                            }

                            .typing-dot:nth-child(3) {
                                animation-delay: 0.4s;
                            }

                            @keyframes typing {
                                0%, 60%, 100% {
                                    transform: translateY(0);
                                }
                                30% {
                                    transform: translateY(-10px);
                                }
                            }

                            .chat-input-container {
                                padding: 1.5rem;
                                background: rgba(15, 23, 42, 0.8);
                                border-top: 1px solid rgba(72, 199, 116, 0.2);
                            }

                            .diagnostic-form {
                                display: grid;
                                gap: 1rem;
                            }

                            .form-row {
                                display: grid;
                                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                                gap: 1rem;
                            }

                            .form-group {
                                display: flex;
                                flex-direction: column;
                                gap: 0.5rem;
                            }

                            .form-group label {
                                color: var(--primary-green);
                                font-weight: 600;
                                font-size: 0.9rem;
                            }

                            .form-group select,
                            .form-group input {
                                padding: 0.75rem;
                                background: rgba(30, 41, 59, 0.8);
                                border: 1px solid rgba(72, 199, 116, 0.3);
                                border-radius: 8px;
                                color: var(--text-light);
                                font-size: 1rem;
                                outline: none;
                                transition: border-color 0.3s;
                            }

                            .form-group select:focus,
                            .form-group input:focus {
                                border-color: var(--primary-green);
                            }

                            .send-button {
                                padding: 1rem 2rem;
                                background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
                                border: none;
                                border-radius: 8px;
                                color: white;
                                font-weight: 600;
                                cursor: pointer;
                                transition: transform 0.3s;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                gap: 0.5rem;
                            }

                            .send-button:hover:not(:disabled) {
                                transform: scale(1.02);
                            }

                            .send-button:disabled {
                                opacity: 0.5;
                                cursor: not-allowed;
                            }

                            /* Select2 Dark Theme */
                            .select2-container--default .select2-selection--multiple {
                                background: rgba(30, 41, 59, 0.8) !important;
                                border: 1px solid rgba(72, 199, 116, 0.3) !important;
                                border-radius: 8px !important;
                            }

                            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                                background: var(--primary-green) !important;
                                border: none !important;
                                color: white !important;
                            }

                            .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
                                color: white !important;
                            }

                            .select2-dropdown {
                                background: rgba(30, 41, 59, 0.95) !important;
                                border: 1px solid rgba(72, 199, 116, 0.3) !important;
                            }

                            .select2-results__option {
                                color: var(--text-light) !important;
                            }

                            .select2-results__option--highlighted {
                                background: var(--primary-green) !important;
                            }
                            /* Hero Section with Background */
                            .hero {
                                min-height: 100vh;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                padding: 8rem 2rem 4rem;
                                text-align: center;
                                position: relative;
                                background:
                                    linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 41, 59, 0.85) 100%),
                               url({{ asset('bg.jpeg') }}) center/cover;
                                background-attachment: fixed;
                            }

                            .hero-overlay {
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background: radial-gradient(circle at 50% 50%, transparent 0%, rgba(15, 23, 42, 0.6) 100%);
                                z-index: 1;
                            }

                            .hero-content {
                                position: relative;
                                z-index: 2;
                            }

                            .hero-content h1 {
                                font-size: 3.5rem;
                                font-weight: 700;
                                margin-bottom: 1.5rem;
                                background: linear-gradient(135deg, var(--primary-green), var(--light-green));
                                -webkit-background-clip: text;
                                -webkit-text-fill-color: transparent;
                                background-clip: text;
                                text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                            }

                            .hero-content p {
                                font-size: 1.25rem;
                                color: var(--text-light);
                                max-width: 600px;
                                margin: 0 auto 2rem;
                                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
                            }

                            .hero-buttons {
                                display: flex;
                                gap: 1rem;
                                justify-content: center;
                                flex-wrap: wrap;
                            }

                            /* Animations */
                            @keyframes fadeIn {
                                from {
                                    opacity: 0;
                                    transform: translateY(30px);
                                }
                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            .animate-fade-in {
                                animation: fadeIn 1s ease-out forwards;
                            }

                            .animate-fade-in-delay {
                                opacity: 0;
                                animation: fadeIn 1s ease-out 0.3s forwards;
                            }

                            .animate-fade-in-delay-2 {
                                opacity: 0;
                                animation: fadeIn 1s ease-out 0.6s forwards;
                            }

                            /* Floating Icons */
                            .floating-icons {
                                position: absolute;
                                width: 100%;
                                height: 100%;
                                top: 0;
                                left: 0;
                                pointer-events: none;
                                z-index: 1;
                                overflow: hidden;
                            }

                            .floating-icon {
                                position: absolute;
                                font-size: 3rem;
                                color: rgba(72, 199, 116, 0.15);
                                animation: float 20s infinite ease-in-out;
                                animation-delay: var(--delay);
                            }

                            .floating-icon:nth-child(1) {
                                top: 20%;
                                left: 10%;
                            }

                            .floating-icon:nth-child(2) {
                                top: 60%;
                                left: 85%;
                            }

                            .floating-icon:nth-child(3) {
                                top: 80%;
                                left: 15%;
                            }

                            .floating-icon:nth-child(4) {
                                top: 30%;
                                left: 80%;
                            }

                            @keyframes float {
                                0%, 100% {
                                    transform: translateY(0) rotate(0deg);
                                }
                                25% {
                                    transform: translateY(-30px) rotate(5deg);
                                }
                                50% {
                                    transform: translateY(0) rotate(0deg);
                                }
                                75% {
                                    transform: translateY(30px) rotate(-5deg);
                                }
                            }

                            /* Button Animations */
                            .btn-primary {
                                position: relative;
                                overflow: hidden;
                            }

                            .btn-primary::before {
                                content: '';
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                width: 0;
                                height: 0;
                                border-radius: 50%;
                                background: rgba(255, 255, 255, 0.2);
                                transform: translate(-50%, -50%);
                                transition: width 0.6s, height 0.6s;
                            }

                            .btn-primary:hover::before {
                                width: 300px;
                                height: 300px;
                            }

                            /* Parallax Effect on Scroll */
                            @media (prefers-reduced-motion: no-preference) {
                                .hero {
                                    background-attachment: fixed;
                                }
                            }

                            /* Responsive */
                            @media (max-width: 768px) {
                                .hero-content h1 {
                                    font-size: 2rem;
                                }

                                .floating-icon {
                                    font-size: 2rem;
                                }
                            }

                            /* Responsive */
                            @media (max-width: 768px) {
                                .hero-content h1 {
                                    font-size: 2rem;
                                }

                                .nav-links {
                                    display: none;
                                }

                                .chat-messages {
                                    height: 400px;
                                }

                                .message-content {
                                    max-width: 85%;
                                }

                                .form-row {
                                    grid-template-columns: 1fr;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        <!-- Navigation -->
                        <nav class="navbar">
                            <div class="logo">
                         <img src="{{ asset('logo.png') }}" alt="" style="width: 104px; filter: brightness(0) invert(1);">
                            </div>
                            <div class="nav-links">
                                @auth
                                    <a href="{{ url('/home') }}">Dashboard</a>
                                @else
                                    <a href="#features">Features</a>
                                    <a href="#diagnostics">Diagnostics</a>
                                    <a href="{{ route('login') }}">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                                    @endif
                                @endauth
                            </div>
                        </nav>

                        <!-- Hero Section -->
                     <section class="hero">
                            <div class="hero-overlay"></div>
                            <div class="hero-content">
                                <h1 class="animate-fade-in">Smart Livestock Management</h1>
                                <p class="animate-fade-in-delay">Monitor health, track records, manage vaccinations, and get AI-powered diagnostics for your livestock - all in one place.</p>
                                <div class="hero-buttons animate-fade-in-delay-2">
                                    @auth
                                        <a href="{{ url('/home') }}" class="btn-primary">Go to Dashboard</a>
                                    @else
                                        <a href="{{ route('register') }}" class="btn-primary">Start Free Trial</a>
                                        <a href="#diagnostics" class="btn-primary" style="background: transparent; border: 2px solid var(--primary-green);">Try Diagnostics</a>
                                    @endauth
                                </div>
                            </div>
                            <div class="floating-icons">
                                <i class="fas fa-cow floating-icon" style="--delay: 0s;"></i>
                                <i class="fas fa-horse floating-icon" style="--delay: 1s;"></i>
                                <i class="fas fa-sheep floating-icon" style="--delay: 2s;"></i>
                                <i class="fas fa-chicken floating-icon" style="--delay: 1.5s;"></i>
                            </div>
                        </section>

                        <!-- Features Section -->
                        <section id="features" class="features">
                            <h2>Comprehensive Farm Management</h2>
                            <div class="features-grid">
                                <div class="feature-card">
                                    <div class="feature-icon"><i class="fas fa-notes-medical"></i></div>
                                    <h3>Health Records</h3>
                                    <p>Track symptoms, diagnoses, treatments, and prevention measures for all your livestock.</p>
                                </div>
                                <div class="feature-card">
                                    <div class="feature-icon"><i class="fas fa-syringe"></i></div>
                                    <h3>Vaccination Tracking</h3>
                                    <p>Never miss a vaccination date with automated reminders and comprehensive records.</p>
                                </div>
                                <div class="feature-card">
                                    <div class="feature-icon"><i class="fas fa-robot"></i></div>
                                    <h3>AI Diagnostics</h3>
                                    <p>Get instant preliminary diagnoses using our advanced AI-powered chatbot.</p>
                                </div>
                                <div class="feature-card">
                                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                                    <h3>Analytics Dashboard</h3>
                                    <p>Visualize trends and make data-driven decisions for better farm management.</p>
                                </div>
                                <div class="feature-card">
                                    <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                                    <h3>Task Management</h3>
                                    <p>Schedule and track feeding, medication, and routine care activities.</p>
                                </div>
                                <div class="feature-card">
                                    <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                                    <h3>Mobile Friendly</h3>
                                    <p>Access your farm data anywhere, anytime from any device.</p>
                                </div>
                            </div>
                        </section>

                        <!-- Chat Diagnostics Section -->
                        <section id="diagnostics" class="chat-section pc-container">
                            <div class="chat-container pc-content">
                                <div class="chat-messages" id="chatMessages">
                                    <div class="message ai">
                                        <div class="message-avatar"><i class="fas fa-robot"></i></div>
                                        <div class="message-content">
                                            <p>👋 Hello! I'm your AI veterinary assistant. Please provide your livestock details and symptoms below, and I'll help diagnose the issue.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="chat-input-container">
                                    <form id="diagnosticForm" class="diagnostic-form">
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="species"><i class="fas fa-paw"></i> Species</label>
                                                <select id="species" required>
                                                    @foreach($species as $specie)
                                                        <option value="{{ $specie }}">{{ $specie }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="breed"><i class="fas fa-dna"></i> Breed</label>
                                                <!-- empty; options populated by JS per selected species -->
                                                <select name="breed" id="breed" class="form-control select2"  required></select>
                                            </div>

                                            <div class="form-group">
                                                <label for="age_group"><i class="fas fa-birthday-cake"></i> Age Group</label>
                                                <select id="age_group" required>
                                                    @foreach($ages as $age)
                                                        <option value="{{ $age }}">{{ $age }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Replace the symptoms select block with an empty select -->
                                        <div class="form-group">
                                            <label for="symptoms"><i class="fas fa-heartbeat"></i> Symptoms (Select Multiple)</label>
                                            <select id="symptoms" multiple required></select>
                                        </div>

                                        <!-- Replace the key_signs select block with an empty select -->
                                        <div class="form-group">
                                            <label for="key_signs"><i class="fas fa-stethoscope"></i> Key Signs (Select Multiple)</label>
                                            <select id="key_signs" multiple required></select>
                                        </div>

                                        <button type="submit" class="send-button" id="sendButton">
                                            <i class="fas fa-paper-plane"></i>
                                            Get Diagnosis
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </section>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
0
                        <script>
                            // expose PHP species-keyed arrays to JS
                            const SIGNS_BY_SPECIES = @json($signs);
                            const SYMPTOMS_BY_SPECIES = @json($symptoms);
                            const BREEDS_BY_SPECIES = @json($breeds); // pass species => [breeds] from controller

                            // helper to clear and populate a select element (value = raw item, text = pretty)
                            function populateSelect(selector, items, single = false) {
                                const $sel = $(selector);
                                $sel.empty();
                                if (!Array.isArray(items) || items.length === 0) {
                                    $sel.prop('disabled', true);
                                    $sel.trigger('change');
                                    return;
                                }
                                $sel.prop('disabled', false);
                                items.forEach(item => {
                                    const text = String(item).replace(/_/g, ' ');
                                    const option = new Option(text, item, false, false);
                                    $sel.append(option);
                                });
                                if (single) {
                                    // optionally select first item (comment out if you don't want auto-select)
                                    // $sel.val(items[0]).trigger('change');
                                }
                                $sel.trigger('change');
                            }

                            $(document).ready(function() {
                                // initialize Select2 for selects
                                $('#symptoms').select2({ placeholder: 'Select symptoms', allowClear: true, width: '100%' });
                                $('#key_signs').select2({ placeholder: 'Select key signs', allowClear: true, width: '100%' });
                                $('#breed').select2({ placeholder: 'Select breed', allowClear: true, width: '100%' });

                                // update selects for chosen species
                                function updateForSpecies(species) {
                                    const s = String(species);
                                    populateSelect('#symptoms', SYMPTOMS_BY_SPECIES[s] ?? []);
                                    populateSelect('#key_signs', SIGNS_BY_SPECIES[s] ?? []);
                                    populateSelect('#breed', BREEDS_BY_SPECIES[s] ?? [], true);
                                }

                                $('#species').on('change', function() {
                                    updateForSpecies(this.value);
                                });

                                // initial populate on load
                                const initialSpecies = $('#species').val();
                                if (initialSpecies) {
                                    updateForSpecies(initialSpecies);
                                } else {
                                    populateSelect('#symptoms', []);
                                    populateSelect('#key_signs', []);
                                    populateSelect('#breed', []);
                                }

                                // ensure breed is cleared when form resets after submission
                                // (this mirrors clearing for symptoms/key_signs in your submit handler)
                            });
                        </script>
                        <script>
                            // $(document).ready(function() {
                            //     // Initialize Select2
                            //     $('#symptoms').select2({
                            //         placeholder: 'Select symptoms',
                            //         allowClear: true,
                            //         width: '100%'
                            //     });
                            //
                            //     $('#key_signs').select2({
                            //         placeholder: 'Select key signs',
                            //         allowClear: true,
                            //         width: '100%'
                            //     });
                            // });


                            const chatMessages = document.getElementById('chatMessages');
                            const diagnosticForm = document.getElementById('diagnosticForm');
                            const sendButton = document.getElementById('sendButton');

                            diagnosticForm.addEventListener('submit', async function(e) {
                                e.preventDefault();

                                const species = document.getElementById('species').value;
                                const breed = document.getElementById('breed').value;
                                const age_group = document.getElementById('age_group').value;
                                const symptoms = $('#symptoms').val();
                                const key_signs = $('#key_signs').val();

                                if (!species || !breed || !age_group || symptoms.length === 0 || key_signs.length === 0) {
                                    alert('Please fill in all fields');
                                    return;
                                }

                                // Format symptoms and signs
                                const symptoms_list = symptoms.join('|');
                                const signs = key_signs.join('; ');

                                // Add user message
                                const userMessage = `
                                    <strong>Species:</strong> ${species}<br>
                                    <strong>Breed:</strong> ${breed}<br>
                                    <strong>Age Group:</strong> ${age_group}<br>
                                    <strong>Symptoms:</strong> ${symptoms.map(s => s.replace(/_/g, ' ')).join(', ')}<br>
                                    <strong>Key Signs:</strong> ${key_signs.join(', ')}
                                `;
                                addMessage(userMessage, 'user');

                                sendButton.disabled = true;
                                sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Analyzing...';

                                // Show typing indicator
                                const typingIndicator = document.createElement('div');
                                typingIndicator.className = 'message ai';
                                typingIndicator.innerHTML = `
                                    <div class="message-avatar"><i class="fas fa-robot"></i></div>
                                    <div class="typing-indicator active">
                                        <span class="typing-dot"></span>
                                        <span class="typing-dot"></span>
                                        <span class="typing-dot"></span>
                                    </div>
                                `;
                                chatMessages.appendChild(typingIndicator);
                                chatMessages.scrollTop = chatMessages.scrollHeight;

                                try {
                                    const response = await fetch('http://127.0.0.1:8001/diagnose', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            species: species,
                                            breed: breed,
                                            age_group: age_group,
                                            symptoms_list: symptoms_list,
                                            key_signs: signs
                                        })
                                    });

                                    const data = await response.json();

                                    // Remove typing indicator
                                    typingIndicator.remove();

                                    // Format and add AI response with animation
                                    const diagnosisMessage = `
                                        <p>✅ <strong>Diagnosis Complete</strong></p>
                                        <div class="diagnosis-result">
                                            <h4><i class="fas fa-diagnoses"></i> Diagnosis</h4>
                                            <p><strong>Disease:</strong> ${data.disease}</p>

                                            <h4 style="margin-top: 1rem;"><i class="fas fa-pills"></i> Treatment</h4>
                                            <p>${data.treatment}</p>

                                            <h4 style="margin-top: 1rem;"><i class="fas fa-shield-alt"></i> Prevention</h4>
                                            <p>${data.prevention}</p>
                                        </div>
                                    `;
                                    await addAnimatedMessage(diagnosisMessage, 'ai');

                                    // Reset form
                                    diagnosticForm.reset();
                                    $('#symptoms').val(null).trigger('change');
                                    $('#key_signs').val(null).trigger('change');
                                    $('#breed').val(null).trigger('change');

                                } catch (error) {
                                    typingIndicator.remove();
                                    await addAnimatedMessage('❌ Sorry, I encountered an error while processing your request. Please make sure the diagnostic server is running at http://127.0.0.1:8001 and try again.', 'ai');
                                }

                                sendButton.disabled = false;
                                sendButton.innerHTML = '<i class="fas fa-paper-plane"></i> Get Diagnosis';
                            });

                            function addMessage(text, sender) {
                                const messageDiv = document.createElement('div');
                                messageDiv.className = `message ${sender}`;

                                const avatar = sender === 'ai'
                                    ? '<i class="fas fa-robot"></i>'
                                    : '<i class="fas fa-user"></i>';

                                messageDiv.innerHTML = `
                                    <div class="message-avatar">${avatar}</div>
                                    <div class="message-content">${text}</div>
                                `;

                                chatMessages.appendChild(messageDiv);
                                chatMessages.scrollTop = chatMessages.scrollHeight;
                            }

                            async function addAnimatedMessage(html, sender) {
                                const messageDiv = document.createElement('div');
                                messageDiv.className = `message ${sender}`;

                                const avatar = sender === 'ai'
                                    ? '<i class="fas fa-robot"></i>'
                                    : '<i class="fas fa-user"></i>';

                                const contentDiv = document.createElement('div');
                                contentDiv.className = 'message-content';
                                contentDiv.style.opacity = '0';

                                messageDiv.innerHTML = `<div class="message-avatar">${avatar}</div>`;
                                messageDiv.appendChild(contentDiv);
                                chatMessages.appendChild(messageDiv);

                                // Fade in animation
                                contentDiv.style.transition = 'opacity 0.5s ease-in';
                                contentDiv.innerHTML = html;

                                setTimeout(() => {
                                    contentDiv.style.opacity = '1';
                                }, 100);

                                chatMessages.scrollTop = chatMessages.scrollHeight;

                                return new Promise(resolve => setTimeout(resolve, 500));
                            }
                        </script>
                    </body>
                    </html>
