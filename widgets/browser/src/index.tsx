import ChatWidget from './components/ChatWidget';
import ChatWindow from './components/ChatWindow';

export const open = () => window.dispatchEvent(new Event('timbr:open'));
export const close = () => window.dispatchEvent(new Event('timbr:close'));
export const toggle = () => window.dispatchEvent(new Event('timbr:toggle'));

export const identify = () => {
  // TODO: add ability to create/update customer information
  console.warn('`Timbr.identify` has not been implemented yet!');
};

export const Timbr = {
  open,
  close,
  toggle,
};

export {ChatWidget, ChatWindow};

export default ChatWidget;
