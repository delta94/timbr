import React from 'react';
import {Flex, Link} from 'theme-ui';

const TimbrBranding = () => {
  return (
    <Flex m={2} sx={{justifyContent: 'center', alignItems: 'center'}}>
      <Link
        href="https://timbr.io?utm_source=timbr&utm_medium=chat&utm_campaign=chat-widget-link"
        target="_blank"
        rel="noopener noreferrer"
        sx={{
          color: 'gray',
          opacity: 0.8,
          transition: '0.2s',
          '&:hover': {opacity: 1},
        }}
      >
        Powered by Timbr
      </Link>
    </Flex>
  );
};

export default TimbrBranding;
