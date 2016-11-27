$(function () {
  'use strict';

  var container = {
    $formCollection:   $('.form-collection'),
    $formDeleteButton: $('.form-delete-button'),
    $formGroup:        $('.form-group')
  };

  function baseEvents() {
    container.$formDeleteButton.click(function () {
      if (!confirm(globalConfig.deleteMessage)) {
        return false;
      }
    });
    if (container.$formCollection.length) {
      container.$formCollection.collection();
    }
  }

  baseEvents();
  console.log(container.$formDeleteButton);
});
