---
paths:
  - resources/views/components/⚡chat-box.blade.php
---

# Components

## Remove the streaming flag once an AI message completes
Streaming placeholders keep a `streaming => true` key. On `stream-complete`/`stream-error` you MUST unset it, otherwise every old assistant bubble re-renders as "AI is thinking..." whenever a later prompt starts streaming (the thinking span is gated on `streamingText === ''` / `$loading`).
