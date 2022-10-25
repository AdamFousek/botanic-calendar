export default class Alert {
  constructor() {
    this.initCloseAlert();
    this.initCloseTimer();
  }

  initCloseAlert() {
    const closeButtons = document.querySelectorAll('[data-alert-close]');

    [...closeButtons].forEach(button => {
      button.addEventListener('click', () => {
        const alertType = button.dataset.alertClose;
        const alert = document.querySelector('[data-alert="'+alertType+'"]');
        alert.remove();
      })
    });
  }

  initCloseTimer() {
    const alertElements = document.querySelectorAll('[data-alert]');

    [...alertElements].forEach(element => {
      setTimeout(function() {
        element.remove();
      }, 5000);
    })
  }
};
