<?php

use Livewire\Component;

new class extends Component
{
    public bool $loading = false;
};
?>

<div class="flex-1 overflow-y-auto px-2 pb-4 space-y-1" x-data="{ openMenu: null }">

        {{-- Header --}}

        <header class="px-6 py-4 border-b border-zinc-800 bg-zinc-900/50 flex items-center justify-between flex-shrink-0">

            <div>
                <h1 class="text-sm font-semibold text-white">New Conversation</h1>
                <p class="text-xs text-zinc-500 mt-0.5">Ask me anything</p>
            </div>

            {{-- Clear button --}}
            <button wire:click="clearChat"
                    class="text-xs text-zinc-500 hover:text-zinc-300 px-3 py-1.5 rounded-md hover:bg-zinc-800 transition-colors cursor-pointer">Clear</button>
        </header>

    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6 scroll-smooth" x-ref="messagesContainer" id="messages">
        {{-- Welcome screen --}}
            <div class="flex flex-col items-center justify-center h-full text-center py-20">

                <div
                    class="w-16 h-16 rounded-2xl bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-2xl font-bold text-white shadow-2xl shadow-violet-900/40 mb-5">
                    LC
                </div>

                <h2 class="text-xl font-semibold text-white mb-2">Welcome to LaraChat</h2>
                <p class="text-zinc-400 text-sm max-w-sm leading-relaxed mb-7">AI assistant powered by Google Gemini &
                    Laravel 13
                    AI SDK</p>

                {{-- Suggestion chips --}}
                <div class="flex flex-wrap gap-2 justify-center max-w-sm">
                    @foreach (['What is Laravel 13?', 'Explain Livewire 4', 'Write a PHP function', 'Tell me a fun fact'] as $suggestion)
                        <button wire:click="$set('input', '{{ $suggestion }}')"
                                class="cursor-pointer px-3 py-1.5 rounded-full bg-zinc-800 border border-zinc-700 text-xs text-zinc-300 hover:border-violet-500 hover:text-white transition-all duration-200">{{ $suggestion }}</button>
                    @endforeach
                </div>
            </div>
    </div>


    {{-- Input text --}}
    <div class="flex-shrink-0 px-4 pb-5 pt-3 border-t border-zinc-800 bg-zinc-900/30">
        <div class="max-w-3xl mx-auto">

            <div class="flex items-center gap-2 bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 focus-within:border-violet-500 transition-colors duration-200"
                 :class="{ 'opacity-60 pointer-events-none': $wire.loading }">

                {{-- Textarea --}}
                <textarea :disabled="$wire.loading" wire:model="input" wire:keydown.enter.prevent="send" rows="1"
                          placeholder="Message Lara AI Chat Agent..."
                          class="flex-1 bg-transparent text-sm text-zinc-100 placeholder-zinc-500 resize-none outline-none leading-relaxed"
                          style="min-height: 28px; height: 28px;"
                          x-on:input="$el.style.height='auto'; $el.style.height=Math.min($el.scrollHeight, 144) + 'px' "></textarea>


                {{-- File attachment --}}
                <input type="file" wire:model="attachment" id="chat-attachment" class="hidden"
                       accept=".pdf,.jpg,.jpeg,.png" />

                {{-- File icon --}}
                <label for="chat-attachment"
                       class="cursor-pointer text-zinc-400 hover:text-white flex-shrink-0 w-8 h-8 rounded-xl hover:bg-zinc-700 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-zinc-400 hover:text-white" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 22 22">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                    </svg>
                </label>




                {{-- Send button --}}
                <button
                        class="cursor-pointer flex-shrink-0 w-8 h-8 rounded-xl bg-violet-600 hover:bg-violet-500 disabled:bg-zinc-700 disabled-opacity-50 disabled:cursor-not-allowed flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.269 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </div>

            <p class="text-center text-xs text-zinc-600 mt-2">LaraChat can make mistakes. Always verify important info.
            </p>
        </div>
    </div>
</div>

