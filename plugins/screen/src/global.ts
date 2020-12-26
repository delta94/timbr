import 'regenerator-runtime/runtime';
import {Screen} from './index';

const w = window as any;
const config = (w.Timbr && w.Timbr.config) || {};
const {accountId, customer, baseUrl, debug} = config;

if (!accountId) {
  throw new Error('An account token is required to start Screen!');
}

Screen.init({
  accountId,
  baseUrl,
  customer,
  debug,
});
