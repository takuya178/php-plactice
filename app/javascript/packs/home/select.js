

  // class Switch {
  //   constructor(obj) {
  //     const link = document.querySelector(obj.selectName);
  //     const text = document.querySelector(obj.tagName);
  //     const check = document.querySelector(obj.checkName);
  //     const image = document.querySelector(obj.imageName)

  //     link.addEventListener('click', (e) => {
  //       this.handleClick(e)
  //       if(text.style.display == 'block') {
  //         text.style.display = 'none'
  //         check.style.display = 'block'
  //       } else {
  //         text.style.display = 'block'
  //         check.style.display = 'none'
  //       }
  //       image.classList.toggle('filter');
  //     });
  //   }

  //   handleClick = (e) => {
  //     e.preventDefault();
  //   }
  // }

  const $link_button = document.getElementsByTagName('a')
  

  const sugar_link = $link_button[1];
  const sugar_text = document.querySelector('#js-sugar-text');
  const sugar_check = document.querySelector('#js-sugar-check');
  const sugar_image = document.querySelector('#js-sugar-image');

  const lipid_link = $link_button[2]
  const lipid_text = document.querySelector('#js-lipid-text');
  const lipid_check = document.querySelector('#js-lipid-check');
  const lipid_image = document.querySelector('#js-lipid-image');

  const salt_link = $link_button[3]
  const salt_text = document.querySelector('#js-salt-text');
  const salt_check = document.querySelector('#js-salt-check');
  const salt_image = document.querySelector('#js-salt-image');


  const sugarId = [];
  const lipidId = [];
  const saltId = [];

  const button = document.querySelector('#js-button');

  const handleClick = (e) => {
    e.preventDefault();
  }


  // 糖質部分がクリックされた処理
  sugar_link.addEventListener('click', (e) => {
    handleClick(e)
    if(sugar_text.style.display == 'block') {
      sugar_text.style.display = 'none'
      sugar_check.style.display = 'block'
      sugarId.push(sugar_link.dataset.name)
    } else {
      sugar_text.style.display = 'block'
      sugar_check.style.display = 'none'
      sugarId.pop(sugar_link.dataset.name)
    }
    sugar_image.classList.toggle('filter');
    console.log(sugarId)
  });

  // 脂質部分がクリックされた処理
  lipid_link.addEventListener('click', (e) => {
    handleClick(e)
    if(lipid_text.style.display == 'block') {
      lipid_text.style.display = 'none'
      lipid_check.style.display = 'block'
      lipidId.push(lipid_link.dataset.name)
    } else {
      lipid_text.style.display = 'block'
      lipid_check.style.display = 'none'
      lipidId.pop(lipid_link.dataset.name)
    }
    lipid_image.classList.toggle('filter');
    console.log(lipidId)
  });

  // 塩分がクリックされた処理
  salt_link.addEventListener('click', (e) => {
    handleClick(e)
    if(salt_text.style.display == 'block') {
      salt_text.style.display = 'none'
      salt_check.style.display = 'block'
      saltId.push(salt_link.dataset.name)
    } else {
      salt_text.style.display = 'block'
      salt_check.style.display = 'none'
      saltId.pop(salt_link.dataset.name)
    }
    salt_image.classList.toggle('filter');
    console.log(saltId)
  });

  // ボタンを押して/resultページへ
  button.addEventListener('click', () => {
    $.ajax({
      type: 'get',
      url: '/foods',
      data: {
        sugar_tag: sugarId,
        lipid_tag: lipidId,
        salt_tag: saltId, 
      }
    }).done(() => {
      window.location.href = '/foods?sugar%5B%5D=' + sugarId + '&lipid%5B%5D=' + lipidId + '&salt%5B%5D=' + saltId;
    });
  });
