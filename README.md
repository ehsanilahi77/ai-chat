# Ehsan AI Chat

A streaming AI chat application built with **Laravel 13**, the **Laravel AI SDK** (`laravel/ai`), and **Livewire 4**. It provides a ChatGPT-style interface powered by Google Gemini (configurable to any supported provider) with real-time token streaming, markdown rendering, and syntax-highlighted code blocks.

<img width="1917" height="631" alt="image" src="https://github.com/user-attachments/assets/4a650ba7-aba3-4294-b5c4-9c8735d05209" />


## Features

- **Real-time streaming responses** – AI output is streamed token-by-token to the browser using a Server-Sent Events (SSE) endpoint (`text/event-stream`).
- **Markdown rendering** – Assistant responses are rendered as markdown with GitHub-flavored syntax and automatic syntax highlighting via `marked` + `highlight.js`.
- **File attachments** – Attach PDF, JPG, or PNG files (up to 10 MB) to a message.
- **Suggestion chips** – One-click example prompts on the welcome screen.
- **Conversation management** – Start a new conversation and clear the current chat.
- **Multi-provider AI support** – Defaults to Google Gemini but supports OpenAI, Anthropic, Azure, Groq, DeepSeek, Mistral, Ollama, Cohere, xAI, OpenRouter, and more via the Laravel AI SDK.
- **Conversation persistence ready** – Migrations included for storing conversations and messages (`agent_conversations`, `agent_conversation_messages`).
- **Dark, responsive UI** – Tailwind CSS 4 with a zinc/violet theme.

<img width="1920" height="1084" alt="image" src="https://github.com/user-attachments/assets/f597080f-73d2-425e-8be2-3490ce55fdc7" />


## Tech Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.4, Laravel 13 |
| AI | `laravel/ai` (Laravel AI SDK) v0.10 |
| Frontend | Livewire 4, Alpine.js, Tailwind CSS 4, Vite 8 |
| Markdown | `marked`, `marked-highlight`, `highlight.js` |
| Database | SQLite (default) / MySQL |
| Testing | Pest 5, PHPStan (Larastan), Laravel Pint |

## Requirements

- PHP ^8.3
- Composer
- Node.js & npm
- An API key for at least one AI provider (default: Gemini)

## Installation

```bash
# Clone the repository, then:
composer setup
```

`composer setup` runs the full install: dependencies, `.env` file, app key, migrations, frontend assets.

For a manual setup:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

## Configuration

### AI Provider

Set your default provider's API key in `.env`. The default provider is Gemini:

```dotenv
GEMINI_API_KEY=your-key-here
```

Any of the following providers can be configured in `config/ai.php` (and swapped as the default):

- `anthropic`, `azure`, `bedrock`, `cohere`, `deepseek`, `eleven`, `gemini`, `groq`, `jina`, `mistral`, `ollama`, `openai`, `openai-compatible`, `openrouter`, `voyageai`, `xai`

Each provider uses its own `*_API_KEY` environment variable (e.g. `OPENAI_API_KEY`, `ANTHROPIC_API_KEY`).

### Database

The app defaults to SQLite. To use MySQL, update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env`, then run `php artisan migrate`.

## Running the App

Start both servers (backend + Vite dev server) with:

```bash
composer run dev
```

Or run them separately:

```bash
php artisan serve
npm run dev
```

Then visit `http://localhost:8000`.

## Routes

| Method | URI | Name | Description |
| --- | --- | --- | --- |
| GET | `/` | `home` | Welcome / landing page |
| GET | `/chat` | `chat` | AI chat interface |
| POST | `/chat/stream` | `chat.stream` | SSE endpoint that streams AI responses |

## How It Works

1. The user sends a message from the Livewire `chat-box` component.
2. The browser POSTs to `POST /chat/stream` and consumes a **Server-Sent Events** stream (`StreamController`).
3. The `ChatAgent` (`app/Ai/Agents/ChatAgent.php`) applies its system instructions and streams `TextDelta` events from the AI provider.
4. Each `data:` event appends text to the current bubble; `data: [DONE]` signals the end of the response.
5. Responses are rendered as markdown with code highlighting on the client.

## Project Structure

```
app/
├── Ai/Agents/
│   └── ChatAgent.php          # AI agent definition & system instructions
├── Http/Controllers/
│   └── StreamController.php   # SSE streaming endpoint
└── Models/User.php

config/ai.php                  # AI provider configuration

database/migrations/
└── 2026_08_13_110251_create_agent_conversations_table.php

resources/views/
├── pages/⚡chat.blade.php      # Chat page (Livewire SFC) with sidebar
├── components/⚡chat-box.blade.php  # Chat input, messages, streaming logic
└── layouts/app.blade.php

routes/web.php                 # Route definitions
```

## Testing

```bash
composer test        # Pint (style) + PHPStan (types) + Pest test suite
php artisan test     # Run tests only
```

## Scripts

| Command | Description |
| --- | --- |
| `composer setup` | Full project setup |
| `composer run dev` | Run dev servers (backend + Vite) |
| `composer test` | Run lint, static analysis, and tests |
| `npm run build` | Build production assets |

## License

This project is open-sourced under the MIT license (see `composer.json`).
