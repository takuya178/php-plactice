  const $tab = document.getElementById('tab');
  const $link = $tab.querySelectorAll('a');
  const $img = $tab.querySelectorAll('img');
  const $text = $tab.querySelectorAll('h2');
  const $check = $tab.querySelectorAll('h1');
  const component = document.querySelector('#js-component');
  const genre = document.querySelector('#js-genre');
  const button = document.querySelector('#js-button');

  const componentId = [];
  const genreId = [];

  const handleClick = (e) => {
    e.preventDefault();
  }

  // 成分画像をクリックしたときの動作
  for(let i = 0; i < 3; i++) {
    $link[i].addEventListener('click', (e) => {
      handleClick(e)
      if($text[i].style.display == 'block') {
        $text[i].style.display = 'none'
        $check[i].style.display = 'block'
        componentId.push($link[i].dataset.id)
      } else {
        $text[i].style.display = 'block'
        $check[i].style.display = 'none'
        componentId.pop($link[i].dataset.id)
      }
      console.log(componentId)
      $img[i].classList.toggle('filter');
    });
  }

  // ジャンル選択画面へ
  button.addEventListener('click', () => {
    component.style.display = 'none'
    genre.style.display = 'block'
  });



  
  // ボタンを押して/resultページへ
  for(let i = 3; i < 7; i++) {
    $link[i].addEventListener('click', () => {
      genreId.push($link[i].dataset.id)

      $.ajax({
        type: 'get',
        url: '/food_combinations',
        data: {
          component: componentId,
          genre: genreId
        }
      }).done(() => {
        if (componentId.length == 1) {
          window.location.href = '/food_combinations?component%5B%5D=' + componentId[0] + '&genre%5B%5D=' + genreId;
        } else if (componentId.length == 2) {
          window.location.href = '/food_combinations?component%5B%5D=' + componentId[0] + '&component%5B%5D=' + componentId[1] + '&genre%5B%5D=' + genreId;
        } else if (componentId.length == 3) {
          window.location.href = '/food_combinations?component%5B%5D=' + componentId[0] + '&component%5B%5D=' + componentId[1] + '&component%5B%5D=' + componentId[2] + '&genre%5B%5D=' + genreId;
        }
      });
    });
  }