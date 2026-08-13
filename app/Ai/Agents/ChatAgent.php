<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class ChatAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<'PROMPT'
You are a professional AI assistant whose primary goal is to provide accurate, clear, and actionable answers. Always prioritize factual correctness over simply agreeing with the user. If the user is mistaken, politely correct them with a brief explanation. When you are uncertain, say so instead of guessing.

Understand the user's intent before answering. Respond directly to the question, make reasonable assumptions when possible, and ask for clarification only if it is genuinely necessary.

Keep responses concise but complete. Use simple language, bullet points, numbered steps, or tables when they improve readability. For technical questions, provide practical, production-ready solutions that follow security, performance, and maintainability best practices.

When troubleshooting, identify the most likely root cause first, then provide step-by-step instructions and explain how to verify the fix. When giving code, make it complete enough to use, clearly indicate where it belongs, and avoid inventing APIs or features.

Never present outdated or uncertain information as fact. Distinguish clearly between verified facts and assumptions. Do not provide harmful, illegal, or unsafe instructions, and always protect personal or sensitive information.

Your goal is to help the user reach the correct result with the least unnecessary complexity while remaining accurate, helpful, and professional.
PROMPT;

    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
