import { useState } from 'react';
import { Link } from 'react-router-dom';
import bot from '../data/chatbot';
import { track, whatsappLink } from '../lib/site';
import { usePage } from '../context/PageContext';

export default function Chatbot() {
  const { waMessage } = usePage();
  const [open, setOpen] = useState(false);
  const [messages, setMessages] = useState([{ who: 'bot', text: bot.welcome }]);
  const [actions, setActions] = useState(bot.quick_replies);

  function toggle() {
    if (!open) track('chatbot_open');
    setOpen(!open);
  }

  function go(id, label) {
    if (label) setMessages((m) => [...m, { who: 'user', text: label }]);
    track('chatbot_service_click', { id, label });
    const node = bot.nodes[id];
    if (!node) {
      setMessages((m) => [...m, { who: 'bot', text: 'I can connect you with the team for that.' }]);
      setActions(bot.nodes.expert?.buttons || []);
      return;
    }
    setMessages((m) => [...m, { who: 'bot', text: node.message, node }]);
    setActions(node.buttons || []);
  }

  const lastNode = [...messages].reverse().find((m) => m.node)?.node;

  return (
    <div data-chatbot>
      <button className="chatbot-toggle" type="button" aria-expanded={open} aria-label="Open chat assistant" onClick={toggle}>
        <i className="bi bi-chat-dots" aria-hidden="true" />
      </button>
      <div className={`chatbot-panel ${open ? 'open' : ''}`} role="dialog" aria-label="Digital growth assistant" aria-hidden={!open}>
        <div className="chatbot-head">
          <strong>Inryth Assistant</strong>
          <button type="button" className="btn btn-ghost" style={{ minHeight: 36, padding: '6px 10px' }} onClick={() => setOpen(false)}>Close</button>
        </div>
        <div className="chatbot-messages">
          {messages.map((msg, i) => (
            <div key={i} className={msg.who === 'user' ? 'user-msg' : 'bot-msg'}>{msg.text}</div>
          ))}
        </div>
        <div className="chatbot-actions">
          {actions.map((btn) => (
            <button key={btn.id} type="button" onClick={() => go(btn.id, btn.label)}>{btn.label}</button>
          ))}
          {lastNode?.link && <Link to={lastNode.link}>{lastNode.link_label || 'Learn more'}</Link>}
          {lastNode?.whatsapp && (
            <a href={whatsappLink(waMessage, 'chatbot')} target="_blank" rel="noopener" onClick={() => track('whatsapp_click', { label: 'chatbot' })}>
              {lastNode.whatsapp_label || 'WhatsApp'}
            </a>
          )}
          {lastNode?.cta && !lastNode.buttons && (
            <button type="button" onClick={() => go('expert', 'Talk to Expert')}>Talk to Expert</button>
          )}
        </div>
      </div>
    </div>
  );
}
