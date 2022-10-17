export default class Search {
  constructor() {
    this.init();
  }

  init() {
    console.log('test');
    this.initTabs();
  }

  initTabs() {
    const tabLinks = document.getElementsByClassName('search-tab');

    [...tabLinks].forEach((element) => {
      element.addEventListener('click', (event) => {
        const targetElement = event.target;
        const allTabs = document.getElementsByClassName('search-tab-content');
        [...allTabs].forEach((element) => {
            element.classList.add('hidden');
        });
        const content = document.getElementById(targetElement.dataset.tabsTarget);
        content.classList.remove('hidden');
      })
    });
  }
}