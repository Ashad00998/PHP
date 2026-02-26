<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>👵 Глухая бабушка</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h1 {
            text-align: center;
            padding: 25px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            margin: 0;
            font-size: 2.2em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }

        .chat-container {
            padding: 25px;
            background: #f8f9fa;
        }

        .chat-messages {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            scroll-behavior: smooth;
        }

        .message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message.grandma {
            flex-direction: row;
        }

        .message.user {
            flex-direction: row-reverse;
        }

        .avatar {
            font-size: 2em;
            margin: 0 10px;
            filter: drop-shadow(2px 2px 2px rgba(0, 0, 0, 0.2));
        }

        .message-content {
            max-width: 70%;
            padding: 12px 18px;
            border-radius: 20px;
            font-size: 1.1em;
            line-height: 1.4;
            position: relative;
            word-wrap: break-word;
        }

        .grandma .message-content {
            background: linear-gradient(135deg, #ffdde1 0%, #ee9ca7 100%);
            border-bottom-left-radius: 5px;
            color: #2d3436;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user .message-content {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border-bottom-right-radius: 5px;
            color: #2d3436;
            box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chat-input-container {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
        }

        #userInput {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            font-size: 1em;
            transition: all 0.3s ease;
            outline: none;
            background: white;
        }

        #userInput:focus {
            border-color: #f5576c;
            box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.2);
        }

        #sendButton {
            padding: 15px 30px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.3);
        }

        #sendButton:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 87, 108, 0.4);
        }

        #sendButton:active {
            transform: translateY(0);
        }

        .hint {
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            font-size: 0.95em;
            color: #856404;
        }

        .hint p {
            margin: 5px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .counter {
            background: linear-gradient(135deg, #a8edea 0%, #b2fefa 100%);
            padding: 15px 25px;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            color: #2d3436;
            border-top: 2px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .counter.warning {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
            100% {
                opacity: 1;
            }
        }

        .timestamp {
            font-size: 0.7em;
            color: #666;
            margin-top: 5px;
            text-align: right;
        }

        /* Стили для скроллбара */
        .chat-messages::-webkit-scrollbar {
            width: 8px;
        }

        .chat-messages::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #f5576c;
            border-radius: 10px;
        }

        .chat-messages::-webkit-scrollbar-thumb:hover {
            background: #f093fb;
        }

        /* Адаптивность */
        @media (max-width: 600px) {
            .container {
                border-radius: 15px;
            }

            h1 {
                font-size: 1.8em;
                padding: 20px;
            }

            .chat-container {
                padding: 15px;
            }

            .message-content {
                max-width: 85%;
                font-size: 1em;
            }

            #sendButton {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>👵 Глухая бабушка</h1>

        <div class="chat-container">
            <div class="chat-messages" id="chatMessages">
                <div class="message grandma">
                    <span class="avatar">👵</span>
                    <div class="message-content">
                        ЧЕГО СКАЗАТЬ-ТО ХОТЕЛ, МИЛОК?!
                        <div class="timestamp">только что</div>
                    </div>
                </div>
            </div>

            <div class="chat-input-container">
                <input type="text" id="userInput" placeholder="Напиши что-нибудь бабуле..." autocomplete="off">
                <button id="sendButton">Сказать</button>
            </div>

            <div class="hint">
                <p>🔊 <strong>Кричи!</strong> Добавь <strong>!</strong> в конце, чтобы бабушка услышала</p>
                <p>👋 <strong>Уйти:</strong> Крикни <strong>ПОКА!</strong> три раза подряд</p>
                <p>🎲 <strong>Сюрприз:</strong> Бабушка называет случайный год от 1930 до 1950</p>
            </div>
        </div>

        <div class="counter" id="goodbyeCounter">
            Осталось криков ПОКА!: 3
        </div>
    </div>

    <script>
        class DeafGrandma {
            constructor() {
                this.goodbyeCount = 0;
                this.REQUIRED_GOODBYES = 3;
                this.YEAR_MIN = 1930;
                this.YEAR_MAX = 1950;

                this.chatMessages = document.getElementById('chatMessages');
                this.userInput = document.getElementById('userInput');
                this.sendButton = document.getElementById('sendButton');
                this.goodbyeCounter = document.getElementById('goodbyeCounter');

                this.init();
            }

            init() {
                this.sendButton.addEventListener('click', () => this.handleUserInput());
                this.userInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        this.handleUserInput();
                    }
                });

                // Фокус на поле ввода при загрузке
                this.userInput.focus();
            }

            getCurrentTime() {
                const now = new Date();
                return now.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });
            }

            addMessage(text, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender}`;

                const avatar = document.createElement('span');
                avatar.className = 'avatar';
                avatar.textContent = sender === 'grandma' ? '👵' : '👨';

                const contentDiv = document.createElement('div');
                contentDiv.className = 'message-content';

                const textDiv = document.createElement('div');
                textDiv.textContent = text;

                const timestamp = document.createElement('div');
                timestamp.className = 'timestamp';
                timestamp.textContent = this.getCurrentTime();

                contentDiv.appendChild(textDiv);
                contentDiv.appendChild(timestamp);

                if (sender === 'grandma') {
                    messageDiv.appendChild(avatar);
                    messageDiv.appendChild(contentDiv);
                } else {
                    messageDiv.appendChild(contentDiv);
                    messageDiv.appendChild(avatar);
                }

                this.chatMessages.appendChild(messageDiv);
                this.chatMessages.scrollTop = this.chatMessages.scrollHeight;
            }

            updateCounter() {
                const remaining = this.REQUIRED_GOODBYES - this.goodbyeCount;
                this.goodbyeCounter.textContent = `Осталось криков ПОКА!: ${remaining}`;

                if (remaining === 1) {
                    this.goodbyeCounter.classList.add('warning');
                } else {
                    this.goodbyeCounter.classList.remove('warning');
                }
            }

            getRandomYear() {
                return Math.floor(Math.random() * (this.YEAR_MAX - this.YEAR_MIN + 1)) + this.YEAR_MIN;
            }

            handleUserInput() {
                const input = this.userInput.value.trim();

                if (input === '') {
                    return;
                }

                // Добавляем сообщение пользователя
                this.addMessage(input, 'user');

                // Обрабатываем ввод
                this.processInput(input);

                // Очищаем поле ввода
                this.userInput.value = '';
                this.userInput.focus();
            }

            processInput(input) {
                // Проверяем, является ли ввод ТОЛЬКО "ПОКА!"
                if (input === "ПОКА!") {
                    this.goodbyeCount++;
                    this.updateCounter();

                    if (this.goodbyeCount >= this.REQUIRED_GOODBYES) {
                        this.addMessage("ДО СВИДАНИЯ, МИЛЫЙ! 👋", 'grandma');

                        // Блокируем ввод после прощания
                        this.userInput.disabled = true;
                        this.sendButton.disabled = true;
                        this.sendButton.style.opacity = '0.5';
                        this.sendButton.style.cursor = 'not-allowed';

                        // Добавляем эффект завершения
                        this.goodbyeCounter.textContent = '🎉 Разговор окончен! 🎉';
                        this.goodbyeCounter.style.background = 'linear-gradient(135deg, #a8e6cf 0%, #d4edda 100%)';
                    } else {
                        const year = this.getRandomYear();
                        this.addMessage(`НЕТ, НИ РАЗУ С ${year} ГОДА!`, 'grandma');
                    }
                }
                // Проверяем, кричит ли внук (заканчивается на !)
                else if (input.endsWith('!')) {
                    this.goodbyeCount = 0;
                    this.updateCounter();

                    // Проверяем, содержит ли сообщение "ПОКА!" (но не равно ему)
                    if (input.includes("ПОКА!")) {
                        const year = this.getRandomYear();
                        this.addMessage(`НЕТ, НИ РАЗУ С ${year} ГОДА!`, 'grandma');
                    } else {
                        const year = this.getRandomYear();
                        this.addMessage(`НЕТ, НИ РАЗУ С ${year} ГОДА!`, 'grandma');
                    }
                }
                else {
                    this.goodbyeCount = 0;
                    this.updateCounter();
                    this.addMessage("АСЬ?! ГОВОРИ ГРОМЧЕ, ВНУЧЕК! 👂", 'grandma');
                }
            }
        }

        // Создаем экземпляр класса при загрузке страницы
        document.addEventListener('DOMContentLoaded', () => {
            new DeafGrandma();
        });
    </script>
</body>
</html>
