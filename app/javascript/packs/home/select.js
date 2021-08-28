(() =>{

  class Switch {
    constructor(obj) {
      const link = document.querySelector(obj.selectName);
      const text = document.querySelector(obj.tagName);
      const check = document.querySelector(obj.checkName);

      link.addEventListener('click', (e) => {
        this.handleClick(e)
        if(text.style.display == 'block') {
          text.style.display = 'none'
          check.style.display = 'block'
        } else {
          text.style.display = 'block'
          check.style.display = 'none'
        }
      });
    }

    handleClick = (e) => {
      e.preventDefault();
    }
  }

  const sugar = new Switch({
    selectName: '#js-sugar-select',
    tagName: '#js-sugar-text',
    checkName: '#js-sugar-check'
  });

  const lipid = new Switch({
    selectName: '#js-lipid-select',
    tagName: '#js-lipid-text',
    checkName: '#js-lipid-check'
  });

  const salt = new Switch({
    selectName: '#js-salt-select',
    tagName: '#js-salt-text',
    checkName: '#js-salt-check'
  });

  // const $get = document.getElementById('js-tab')
  // const link = document.getElementById('js_select')
  // const check = document.getElementById('js-check')
  // const text = document.getElementById('js-text')
  // クリックされたときのイベント

  // const handleClick = (e) => {
  //   e.preventDefault();
  // }
  // link.addEventListener('click', (e) => {
  //   handleClick(e)
  //   if(text.style.display == 'block') {
  //     text.style.display = 'none'
  //     check.style.display = 'block'
  //   } else {
  //     text.style.display = 'block'
  //     check.style.display = 'none'
  //   }
  // });
})();