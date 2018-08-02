window.$ = window.jQuery = require('jquery');
//window.UIkit = require('uikit');

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

// loads the Icon plugin
UIkit.use(Icons);

// global Uikit
window.UIkit = UIkit;

require('./modal');

/*UIkit.notification({
  message: 'Привет :)',
  status: 'danger',
  pos: 'bottom-center',
  timeout: 5000
});*/
