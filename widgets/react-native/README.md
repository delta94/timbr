# @timbr/react-native-widget

Timbr chat widget for React Native.

## Install

```bash
npm install --save @timbr/react-native-widget
```

## Usage

First, sign up at https://app.timbr.io/register to get your account token. Your account token is what you will use to pass in as the `accountId` prop below.

***NB**: make sure to pass in an `external_id` with the `customer` prop so that we can identify the person you're chatting with and load their message history if you've chatted with them before! (See below for an example)*

You can render the chat widget however you like. Here's how you might do it in a modal:

```tsx
import React from 'react';
import {StyleSheet, Button, View} from 'react-native';
import Modal from 'react-native-modal';
import ChatWidget from '@timbr/react-native-widget';

export default function App() {
  const [isModalVisible, setModalVisible] = React.useState(false);

  return (
    <View style={{flex: 1, padding: 24}}>
      <Button title="Open chat" onPress={() => setModalVisible(true)} />

      <Modal
        isVisible={isModalVisible}
        onBackdropPress={() => setModalVisible(false)}
      >
        <View style={styles.modal}>
          <ChatWidget
            // Update this with your own account token!
            accountId="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx"
            title="Welcome to Timbr!"
            subtitle="We'll reply as soon as we can 😊"
            greeting="Hi there! :wave: Have any questions?"
            customer={{
              // Update this with a unique identifer for the customer/user,
              // so that we can load the message history if you've chatted
              // with this person in the past!
              external_id: 'xxxxxxxx',
              email: 'alex@test.com',
              name: 'Alex',
            }}
          />
        </View>
      </Modal>
    </View>
  );
}

const styles = StyleSheet.create({
  modal: {
    flex: 1,
    borderRadius: 4,
    overflow: 'hidden',
  },
});
```
