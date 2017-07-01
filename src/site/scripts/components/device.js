var device = (function(){
  /* Regroupe des informations sur le device qui browse le site ! alerte jargon
  Void -> Void */
  "use strict";
  var device = {};
  device.touch = false;

  function constructor(){
    /* constructeur
    Void -> Void */
    try {
      device.touch = ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0) || (typeof el.ongesturestart == "function");
    } catch (e) {
      device.touch = false;
    }
  }

  constructor();
  return device;
})();
