(function ($) {
  'use strict';

  function initTimbrWidget() {
    window.Timbr = {
      config: {
        accountId: timbrVars.accountId,
        title: timbrVars.title,
        subtitle: timbrVars.subtitle,
        newMessagePlaceholder: timbrVars.newMessagePlaceholder,
        primaryColor: timbrVars.primaryColor,
        greeting: timbrVars.greeting,
        baseUrl: timbrVars.baseUrl,
        requireEmailUpfront: timbrVars.requireEmailUpfront,
      },
    };
  }

  if (timbrVars.accountId.length > 0) {
    $(window).ready(initTimbrWidget);
  } else {
    console.warn('Timbr account id must be set!');
  }
})(jQuery);
