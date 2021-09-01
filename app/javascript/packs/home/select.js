

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



  const link = document.querySelector('#js-sugar-select');
  const text = document.querySelector('#js-sugar-text');
  const check = document.querySelector('#js-sugar-check');
  const image = document.querySelector('#js-sugar-image');
  const button = document.querySelector('#js-button');
  const tagId = [];

  const handleClick = (e) => {
    e.preventDefault();
  }
  link.addEventListener('click', (e) => {
    handleClick(e)
    if(text.style.display == 'block') {
      text.style.display = 'none'
      check.style.display = 'block'
      tagId.push(link.dataset.id)
    } else {
      text.style.display = 'block'
      check.style.display = 'none'
      tagId.pop(link.dataset.id)
    }
    image.classList.toggle('filter');
    console.log(tagId)
  });

  button.onclick = function(){
  $.ajax({
    type: 'get',
    url: '/result',
    data: {
      tag: tagId,
    }
  }).done(function() {
    window.location.href = '/result?tag%5B%5D=' + tagId
  });
}