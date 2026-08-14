import { Marked } from 'marked';
import { markedHighlight } from 'marked-highlight';
import hljs from 'highlight.js/lib/common';
import 'highlight.js/styles/github-dark.css';

const marked = new Marked(
    markedHighlight({
        langPrefix: 'hljs language-',
        highlight(code, lang) {
            const language = hljs.getLanguage(lang) ? lang : 'plaintext';

            return hljs.highlight(code, { language }).value;
        },
    }),
);

marked.use({
    gfm: true,
    breaks: true,
    renderer: {
        html({ text }) {
            return escapeHtml(text);
        },
        link({ href, title, tokens }) {
            const text = tokens ? this.parser.parseInline(tokens) : href;

            if (!/^(https?:|mailto:)/i.test(href ?? '')) {
                return text;
            }

            return `<a href="${href}" target="_blank" rel="noopener noreferrer"${title ? ` title="${title}"` : ''}>${text}</a>`;
        },
    },
});

function escapeHtml(value) {
    return value
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

window.renderMarkdown = (content) => marked.parse(content ?? '');
