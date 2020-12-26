import {isFunction} from './helpers';

export function getEventTarget(e: any) {
  if (typeof e.target === 'undefined') {
    return e.srcElement;
  } else {
    return e.target;
  }
}

export const registerEvent = (function () {
  /**
   * @param {Object} element
   * @param {string} type
   * @param {function(...*)} handler
   * @param {boolean=} oldSchool
   * @param {boolean=} useCapture
   */
  const register = function (
    element: any,
    type: string,
    handler: any,
    oldSchool: boolean,
    useCapture: boolean
  ) {
    if (!element) {
      console.error('No valid element provided to register');
      return;
    }

    if (element.addEventListener && !oldSchool) {
      element.addEventListener(type, handler, !!useCapture);
    } else {
      const ontype = 'on' + type;
      const oldHandler = element[ontype]; // can be undefined

      element[ontype] = makeHandler(element, handler, oldHandler);
    }
  };

  function makeHandler(element: any, newHandler: any, oldHandlers: any) {
    const handler = (event: any) => {
      event = event || fixEvent(window.event);

      // this basically happens in firefox whenever another script
      // overwrites the onload callback and doesn't pass the event
      // object to previously defined callbacks.  All the browsers
      // that don't define window.event implement addEventListener
      // so the dom_loaded handler will still be fired as usual.
      if (!event) {
        return undefined;
      }

      let ret = true;
      let oldResult, newResult;

      if (isFunction(oldHandlers)) {
        oldResult = oldHandlers(event);
      }

      newResult = newHandler.call(element, event);

      if (false === oldResult || false === newResult) {
        ret = false;
      }

      return ret;
    };

    return handler;
  }

  function fixEvent(event: any) {
    if (event) {
      event.preventDefault = fixEvent.preventDefault;
      event.stopPropagation = fixEvent.stopPropagation;
    }

    return event;
  }

  fixEvent.preventDefault = function (this: any) {
    this.returnValue = false;
  };

  fixEvent.stopPropagation = function (this: any) {
    this.cancelBubble = true;
  };

  return register;
})();
