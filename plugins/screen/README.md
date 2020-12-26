# @timbr/screen

Timbr screen sharing plugin.

## Install

```bash
npm install --save @timbr/screen
```

## Usage

First, sign up at https://app.timbr.io/register to get your account token. Your account token is what you will use to pass in as the `accountId` prop below.

### Using in HTML

Paste the code below between your `<head>` and `</head>` tags:

```html
<!-- 
  Note that if you already have included the `window.Timbr` configuration with the chat widget, 
  you should **NOT** duplicate it here! All the config settings should be the same for now.
-->
<script>
  window.Timbr = {
    config: {
      // Pass in your Timbr account token here after signing up
      accountId: 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx',
      // Optionally pass in metadata to identify the customer
      customer: {
        name: 'Test User',
        email: 'test@test.com',
        external_id: '123',
      },
      // Optionally specify the base URL
      baseUrl: 'https://app.timbr.io',
    },
  };
</script>
<script
  type="text/javascript"
  async
  defer
  src="https://app.timbr.io/screen.js"
></script>
```

_:warning: **Note** that if you already have included the `window.Timbr` configuration with the [chat widget](https://github.com/alxshelepenok/chat-widget#using-in-html), you should **NOT** duplicate it here!_

If you **already** have the config set, just include this script below it:

```html
<script
  type="text/javascript"
  async
  defer
  src="https://app.timbr.io/screen.js"
></script>
```

### Using as an NPM module

Place the code below in any pages on which you would like to render the widget. If you'd like to render it in all pages by default, place it in the root component of your app.

```tsx
import { Screen } from '@timbr/screen';

const st = Screen.init({
  // Pass in your Timbr account token here after signing up 
  accountId: 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx',
  // Optionally specify the base URL
  baseUrl: 'https://app.timbr.io',
});

// If you want to stop the session recording manually, you can call:
// st.finish();

// Otherwise, the recording will stop as soon as the user exits your website.
```
