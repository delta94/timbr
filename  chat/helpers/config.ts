export const DEFAULT_BASE_URL = 'https://app.timbr.io';

export const isDev = (w: any) => {
  return Boolean(
    w.location.hostname === 'localhost' ||
      w.location.hostname === '[::1]' ||
      w.location.hostname.match(
        /^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/
      )
  );
};

export const getWebsocketUrl = (baseUrl) => {
  const url = baseUrl || DEFAULT_BASE_URL;
  const [protocol, host] = url.split('://');
  const isHttps = protocol === 'https';
  return `${isHttps ? 'wss' : 'ws'}://${host}/socket`;
};
