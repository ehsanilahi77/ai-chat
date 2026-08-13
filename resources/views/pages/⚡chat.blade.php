<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="flex h-screen overflow-hidden bg-zinc-950">
    <aside class="w-64 flex-shrink-0 flex flex-col bg-zinc-900 border-r border-zinc-800">

        {{-- Logo --}}
        <div class="p-5 border-b border-zinc-800">
            <div class="flex items-center gap-3">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-violet-500 to-indigo-600 flex items-center justify-center text-white text-sm font-bold shadow-lg">
                    LC
                </div>

                <div>
                    <p class="text-sm font-semibold text-white">LaraChat </p>
                    <p class="text-xs text-zinc-500">Powered by Gemini</p>
                </div>
            </div>
        </div>
        {{-- New chat button --}}
        <div class="p-4">
            <button wire:click="newConversation"
                    class="w-full flex items-center gap-2 px-4 py-2.5 rounded-lg border border-zinc-700 text-zinc-400 hover:bg-zinc-800 hover:text-white transition-all duration-200 text-sm cursor-pointer">+
                New Conversation</button>
        </div>

        <div class="flex-1"></div>

        {{-- Status footer --}}
        <div class="p-4 border-t border-zinc-800 space-y-2">
            <div class="flex items-center gap-2 px-2 py-2 rounded-lg bg-zinc-800/60">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs text-zinc-400">Gemini 2.5 Flash </span>
            </div>

            <p class="text-xs text-zinc-600 px-2">Built with Laravel 13 AI SDK </p>
        </div>
    </aside>

{{-- Chatbox Component   --}}

    <livewire:chat-box />

</div>
